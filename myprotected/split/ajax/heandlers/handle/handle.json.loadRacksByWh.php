<?php 
	$response = array("status" => "failed", "data" => array());
	
	$wh_id = $_POST["wh"];
	if ($wh_id) {
		$q = "SELECT * FROM `osc_wh_racks` WHERE `warehouse_id` = '$wh_id'";
		$racks = $ah->rs($q);
		if ($racks) {
			$response["data"] = $racks;
			$response["status"] = "success";
		}
	}

	echo json_encode($response); exit();
?>