<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Wialon Playground - Show nearby units</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
</head>
<style>
#map { width:480px; height:400px; }
#log { border: 1px solid #c6c6c6; }

#usage-hint { color: gray; }

#latlng.invalid { border-color: red; }

table .unit-name span {
  border-bottom: 1px dashed;
}
table .unit-name:hover {
  cursor: pointer;
  background: #eee;
}

#results-table { display: none; }
#no-results { display: none; }
</style>
<body>

<!-- load map -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.js"></script>

<div id="map"></div>

<p id='usage-hint'>Doubleclick on the map to set position manually</p>

<p>Position: <input id='latlng' type='text' placeholder='latitude, longitude'>
   <button id='find-by-location-button'>Find nearest to the position</button></p>
    <p>Units: <select id='units'><option value='0'>—</option></select>
       <button id='find-by-unit-button'>Find nearest to the unit</button></p>

<table id='results-table'><thead><tr>
  <td>Distance</td>
  <td>Name</td>
  <td>Last message</td>
</tr></thead>
<tbody id='results-table-body'></tbody>
</table>
<p id='no-results'>There is no closest units satisfying search criteria</p>

<p>Maximum units count:
    <select id='max-units'><option>5</option><option>10</option><option>20</option></select></p>
<p>Filter by actuality:
  <select id='last-message-time-filter'>
    <option value='5'>Received message in 5 minutes</option>
    <option value='30'>Received message in 30 minutes</option>
    <option value='60'>Received message in 1 hour</option>
    <option value='360'>Received message in 6 hours</option>
    <option value='720'>Received message in 12 hours</option>
    <option value='1440'>Received message in 24 hours</option>
    <option value='0'>Show all</option>
  </select></p>
<p>Use routing: <input id='use-routing' type='checkbox'></p>
<div id="log"></div>

</body>
</html>
<script>
/*
 * Showing nearby units
 *
 * Usage:
 *   set position in format "latitude, longitude" and press `Find nearest to the position` button
 *   doubleclick on the map to set position of click
 *   choose unit from the list to set position of selected unit
 *   (click `Find nearest to the unit` button to update matching position by current unit position)
 *
 *   You can setup maximum results count/filter by time of last message
 *
 *   If you have checked `Use routing`, then it will calculate distance not geometrically,
 *   but by actual routes via roads, if possible.
 *
 * Implementation:
 *
 *   1. Request data and subscribe for new unit positions:
 *
 *        var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastPosition;
 *
 *        session.updateDataFlags([
 *          {type: 'type', data: 'avl_unit', flags: flags, mode: 0}
 *        ], callback);
 *
 *   2. To find geometrical distance, use wialon.util.Geometry.getDistance:
 *
 *        https://sdk.wialon.com/api/index.html#wialon.util.Geometry~getDistance
 *
 *      This method will always return value in meters.
 *
 *   3. To get distance of routes, use wialon.util.Gis.getOneToManyRoute:
 *
 *        https://sdk.wialon.com/api/index.html#wialon.util.Gis~getOneToManyRoute
 *
 *        wialon.util.Gis.getOneToManyRoute(lat, lon, [{lat: lat1, lon: lon1}, ...], callback);
 *
 *      In callback you will receive error code in first argument and array of results in the second.
 *
 *      For each point successful result will be in the next format:
 *
 *        {
 *         status: 'OK',
 *         distance: {
 *           value: 1492519.84,
 *           text: '1492.52 km'
 *         },
 *         duration: {
 *           value: 61062,
 *           text: '16 h 57 min'
 *         }
 *        }
 *
 *      Results from GIS will always be in meters.
 */

// Token that will be used for auth
// For more info about how to generate token check
// http://sdk.wialon.com/playground/demo/app_auth_token
var TOKEN = '34c9a4c19198c154e81d591d4c15fc5cCE76030E6126726DA8D45EAE88E93FD4872B018B';

// global variables
var map, marker, unitMarkers = [], markerByUnit = {};
var areUnitsLoaded = false;

// for refreshing
var currentPos = null, currentUnit = null;

var isUIActive = true;

function onlyTwoSignsAfterComma(n) {
  return Math.round(n * 100) / 100;
}

// show distance in meters or kilometers with only 2 signs after comma
function prettyPrintDistance(distance) {    
  if (distance < 1000) return Math.ceil(distance) + ' m';
  else return onlyTwoSignsAfterComma(distance / 1000) + ' km';
}

// Unit markers constructor
function getUnitMarker(unit) {
  // check for already created marker
  var marker = markerByUnit[unit.getId()];
  if (marker) return marker;
    
  var unitPos = unit.getPosition();
  
  if (!unitPos) return null;
    
  marker = L.marker([unitPos.y, unitPos.x], {
    clickable: true,
    draggable: false,
    icon: L.icon({
      iconUrl: unit.getIconUrl(32),
      iconAnchor: [16, 16] // set icon center
    })
  });
  marker.on('click', function(e) {
    // select unit in UI
    $('#units').val(unit.getId());
    
    findAndShowNearestUnitsByUnit(unit, getFilterOptions());
  });

  // save marker for access from filtering by distance
  unitMarkers.push(marker);
  markerByUnit[unit.getId()] = marker;
  
  return marker;
}

function displayPosition(lat, lon) {
  // five signs is precise enough
  var displayLat = Math.round(lat * 100000) / 100000,
      displayLon = Math.round(lon * 100000) / 100000;
  
  // show position
  $('#latlng').val(displayLat + ', ' + displayLon);
  // we have got valid position
  $('#latlng').removeClass('invalid');
}

// Print message to log
function msg(text) { $('#log').prepend(text + '<br/>'); }

// gets options from DOM controls
function getFilterOptions() {
  return {
    lastMessageSeconds: parseInt($('#last-message-time-filter').val()) * 60, // in DOM we have minutes
    maxUnits: parseInt($('#max-units').val()),
    useRouting: $('#use-routing').prop('checked')
  };
}
// disable/enable buttons
function toggleActiveUI(toggle) {
  isUIActive = toggle;

  $('#find-by-location-button').prop('disabled', !toggle);
  $('#find-by-unit-button').prop('disabled', !toggle);
}

function init() { // Execute after login succeed
  // get instance of current Session
  var session = wialon.core.Session.getInstance();
  // specify what kind of data should be returned
  var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastPosition;

  // load Icon Library
  session.loadLibrary('itemIcon');
  
  // load items to the current session
  session.updateDataFlags( 
    [{type: 'type', data: 'avl_unit', flags: flags, mode: 0}], // Items specification
    function (error) { // updateDataFlags callback
      if (error) {
        // show error, if update data flags was failed
        msg(wialon.core.Errors.getErrorText(error));
      } else {
        areUnitsLoaded = true;
        msg('Units are loaded');
        
        // add received data to the UI, setup UI events
        initUIData();
      }
    }
  );
}

// will be called after updateDataFlags success
function initUIData() {
  var session = wialon.core.Session.getInstance();

  var units = session.getItems('avl_unit');
  units.forEach(function(unit) {          
    var unitMarker = getUnitMarker(unit);
    if (unitMarker) unitMarker.addTo(map);
    
    // Add option
    $('#units').append($('<option>').text(unit.getName()).val(unit.getId()));
    
    // listen for new messages
    unit.addListener('changePosition', function(event) {
      // event is qx.event.type.Data
      // extract message data
      var pos = event.getData();
      
      // move or create marker, if not exists
      if (pos) {
        if (unitMarker) {
          unitMarker.setLatLng([pos.y, pos.x]);
        } else {
          // create new marker
          unitMarker = getUnitMarker(unit);
          
          // add marker to the map
          if (unitMarker) unitMarker.addTo(map);
          else msg('Got message with pos, but unit don\'t have a position');
        }
      }
    });
  });
  
  // find nearest to the unit choosed from <select>
  function onUnitSelected() {
    var unitId = parseInt($('#units').val());
    
    if (unitId === 0) return;

    var unit = session.getItem(unitId);
    
    if (!unit) {
      msg('No such unit');
      return;
    }
    
    var unitPos = unit.getPosition();
    
    if (!unitPos) {
      msg('Unit haven\'t a position');
      return;
    }
    
    findAndShowNearestUnitsByUnit(unit, getFilterOptions());
  }
  
  // find near unit
  $('#find-by-unit-button').click(onUnitSelected); // by button
  $('#units').change(onUnitSelected); // by unit selection
    
  // find near specified location
  $('#find-by-location-button').click(function() {
    // extracts two numbers divided by non-digits
    var latlngRegex = /^[^\d]*?(-?\d+(?:\.\d+)?)[^\.\d]+?(-?\d+(?:\.\d+)?)[^\d]*$/;
    
    var positionEl = $('#latlng');
    
    var groups = latlngRegex.exec(positionEl.val());
    if (!groups) { // invalid string
      positionEl.addClass('invalid');
      return;
    }
    
    var lat = parseFloat(groups[1]),
        lon = parseFloat(groups[2]);
    
    if (isFinite(lat) && isFinite(lon) && (-90 <= lat && lat <= 90) && (-180 <= lon && lon <= 180)) {
      positionEl.removeClass('invalid');
      
      findAndShowNearestUnitsByPos({
        lat: lat,
        lon: lon
      }, getFilterOptions());
    } else {
      positionEl.addClass('invalid');
    }
  });
  
  // refresh on settings change:
  function doRefresh() {
    if (isUIActive && currentPos) {
      if (currentUnit) findAndShowNearestUnitsByUnit(currentUnit, getFilterOptions());
      else findAndShowNearestUnitsByPos(currentPos, getFilterOptions());
    } // else TODO: cancel current operation & make new request
  }
  
  $('#max-units').change(doRefresh);
  $('#last-message-time-filter').change(doRefresh);
  $('#use-routing').change(doRefresh);
}

function findAndShowNearestUnitsByPos(pos, options) {
  currentUnit = null;
  $('#units').val('0'); // deselect unit
  
  _findAndShowNearestUnits(pos, options);
}
function findAndShowNearestUnitsByUnit(unit, options) {
  currentUnit = unit;
    
  var unitPos = unit.getPosition();
  
  _findAndShowNearestUnits({lat: unitPos.y, lon: unitPos.x}, options, {excludeUnitById: unit.getId()});
}

function _findAndShowNearestUnits(pos, options, _options) {
  // save pos for refreshing
  currentPos = pos;
  // disable UI to prevent second request
  toggleActiveUI(false);

  // center map at selected position
  map.setView([pos.lat, pos.lon]);
    
  // check for units
  if (!areUnitsLoaded) {
    msg('Units are not loaded yet, please, wait.');
    return;
  }
  
  // show coordinates
  displayPosition(pos.lat, pos.lon);
  
  // default filter values, 0 means "no filter, show all"
  var maximumUnits = 0,
      lastMessageTimeFilter = 0,
      useRouting = false,
      excludeUnitById = null;
  
  // get options, if any
  if (options) {
    if (options.lastMessageSeconds) lastMessageTimeFilter = options.lastMessageSeconds;
    if (options.maxUnits) maximumUnits = options.maxUnits;
    if (options.useRouting) useRouting = options.useRouting;
  }
  // extended options
  if (_options) {
    if (typeof _options.excludeUnitById === 'number') excludeUnitById = _options.excludeUnitById;
  }
  
  if (!marker) { // create and show default pointer marker, if not exists
    marker = L.marker(pos, {
      clickable: false,
      draggable: false,
      zIndexOffset: 1000 // show topmost
    });
    marker.addTo(map);
  } else { // set marker position
    marker.setLatLng(pos);
  }
  
      // get authorized session
  var session = wialon.core.Session.getInstance(),
      // get currenlty loaded items
      units = session.getItems('avl_unit');
  
  units = units.filter(function(unit) {
    // exclude units without position and excluded via options
    return Boolean(unit.getPosition()) && (unit.getId() !== excludeUnitById);
  });
  
  // filter by last position time
  if (lastMessageTimeFilter > 0) {
    units = units.filter(function(unit) {
      // compare server time with last position time
      return (session.getServerTime() - unit.getPosition().t) < lastMessageTimeFilter;
    });
  }

  // we use this function if not using routing, or if route is not exists
  function calcGeometryDistanceToUnit(pos, unit) {
    var unitPos = unit.getPosition();
    
    return {
      distance: wialon.util.Geometry.getDistance(pos.lat, pos.lon, unitPos.y, unitPos.x),
      unit: unit
    };
  }
  
  if (useRouting) {
    // extract points, since getOneToManyRoute receives points, not units
    var points = units.map(function(unit) {
      var unitPos = unit.getPosition();
      return {lon: unitPos.x, lat: unitPos.y};
    });
    
    msg('Loading route');
    
    // do a request
    wialon.util.Gis.getOneToManyRoute(pos.lat, pos.lon, points, function(error, data) {
      if (error) { // error was happened
        msg(wialon.core.Errors.getErrorText(error));
        return;
      }
      
      var resultUnits = [];
      
      // extract distances
      data.forEach(function(x, i) {
        if (x.distance) { // get distance from response, if exists
          resultUnits.push({
            distance: x.distance.value,
            unit: units[i]
          });
        } else { // else fallback to Geometry.getDistance
          resultUnits.push(calcGeometryDistanceToUnit(pos, units[i]));
        }
      });
      
      msg('Loaded');
      
      processResults(resultUnits);
    });
  } else {
    // calculate distance from marker for each unit
    units = units.map(function(unit) {
      return calcGeometryDistanceToUnit(pos, unit);
    });
    
    processResults(units);
  }
  
  // sorts, limits, adds results to the table
  function processResults(unitsWithDistance) {
    // sort by distance
    unitsWithDistance.sort(function(a, b) { return a.distance - b.distance; });
    
    // apply maximum units filter
    var showUnitsCount = maximumUnits === 0 ? units.length : Math.min(units.length, maximumUnits);
    
    // remove all rows from result table
    $('#results-table-body').empty();
    
    // add results to the table
    var i;
    for (i = 0; i < showUnitsCount; i++) {
      var unitWithDistance = unitsWithDistance[i];
      
      addResult(unitWithDistance.unit, unitWithDistance.distance);
    }

    if (i > 0) {
      $('#results-table').show();
      $('#no-results').hide();
    } else { // if no results
      $('#results-table').hide();
      $('#no-results').show();
    }
    
    // activate UI
    toggleActiveUI(true);
      
    function addResult(unit, distance) {
      var unitPos = unit.getPosition();
      
      var distanceText = prettyPrintDistance(distance);
      
      var lastMessageTime = wialon.util.DateTime.formatTime(unit.getPosition().t, 1); // 1 - print date, if not current day
      
      // add result to the table
      var tr = $('<tr>');

      tr.append('<td>' + distanceText + '</td>');

      var unitNameTd = $('<td class="unit-name">').append($('<span>').text(unit.getName()));
      tr.append(unitNameTd);

      tr.append('<td>' + lastMessageTime + '</td>');
   
      // open map at unit position
      unitNameTd.click(function() {
        var unitPos = unit.getPosition();
        
        map.setView([unitPos.y, unitPos.x]);
      });
        
      $('#results-table-body').append(tr);
    }
  }
}

function initMap() {
  // create a map in the "map" div, set the view to a given place and zoom
  map = L.map('map', {
    // disable zooming, because we will use double-click to set up marker
    doubleClickZoom: false
  }).setView([52.33745, 9.81056], 12);

  // add an OpenStreetMap tile layer
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    // copyrights
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors | &copy; <a href="http://gurtam.com">Gurtam</a>'
  }).addTo(map);
  
  // handle mouse double-click event
  map.on('dblclick', function(e) {
    if (!isUIActive) return;
      
    // hide hint
    $('#usage-hint').hide();
      
    findAndShowNearestUnitsByPos({lat: e.latlng.lat, lon: e.latlng.lng}, getFilterOptions());
  });
}

// execute when DOM ready
$(document).ready(function () {
  // init session
  wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com");

  wialon.core.Session.getInstance().loginToken(TOKEN, "", // try to login
    function (code) { // login callback
      // if error code - print error message
      if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
      msg('Logged successfully');
      initMap();
      init(); // when login suceed then run init() function
    }
  );
});
</script>