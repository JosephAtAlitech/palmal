<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
  .select-group input.form-control {
    width: 65%
  }

  .select-group select.input-group-addon {
    width: 35%;
  }
</style>
<link rel="stylesheet" href="select2/select2.min.css" />

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>


    <div class="content-wrapper">

      <section class="content-header">
        <h1>Pie Chart</h1>
        <ol class="breadcrumb">
          <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Pie Chart</li>
        </ol>
      </section>

      <section class="content">

        <div class="container">

          <div>
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </section>
    </div>

    <?php include 'includes/footer.php'; ?>

  </div>
  <?php include 'includes/scripts.php'; ?>
  <script src='../bootstrapvalidator.min.js'></script>
  <script src="select2/select2.min.js"></script>
  <script src="../dist/js/chart.min.js"></script>
  <script type="text/javascript">

    var ctx = document.getElementById("myChart").getContext('2d');


    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["A", "C"],
        datasets: [{
          backgroundColor: [
            "#B4FF14",
            "#2ecc71",
          ],
          data: [40, 60]
        }]
      }
    });

  </script>
</body>

</html>