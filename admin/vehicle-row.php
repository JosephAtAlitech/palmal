<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT vehicle_master.id,vehicle_master.vehicle_number,vehicle_master.wUnitID,vehicle_master.v_type,vehicle_master.driver_id,vehicle_master.engineer_id,vehicle_master.oil_tank_capacity,vehicle_master.oil_tank_capacity,
               vehicle_master.purchase_date,vehicle_master.registration_date,vehicle_master.makers_name,manufacturer_name.name,vehicle_master.year_of_manufacture,vehicle_master.chasis_number,vehicle_master.engin_number,vehicle_master.registration_cirtificate,vehicle_master.reg_start_date,vehicle_master.tax_certificate,vehicle_master.tax_start_date,vehicle_master.tax_end_date,vehicle_master.reg_end_date,vehicle_master.insurance_cirtificate,vehicle_master.insu_start_date,vehicle_master.insu_end_date,
                vehicle_master.pollution_cirtificate,vehicle_master.pollu_start_date,vehicle_master.pollu_end_date,vehicle_master.permits,vehicle_master.per_start_date,vehicle_master.per_end_date,vehicle_master.permit_cirtificate,vehicle_master.branch_status,branch_master.branch_name,vehicle_master.create_date,
                vehicle_master.maker_brand,vehicle_master.cc_brand,vehicle_master.fuel_type,vehicle_master.wings_name,vehicle_master.employee_name,vehicle_master.location,vehicle_master.edit_remarks
                FROM `vehicle_master`
                LEFT JOIN manufacturer_name ON manufacturer_name.id=vehicle_master.makers_name
                LEFT JOIN branch_master ON branch_master.id=vehicle_master.branch_status WHERE vehicle_master.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>