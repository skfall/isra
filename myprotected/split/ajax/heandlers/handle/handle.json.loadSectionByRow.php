<?php 
	$response = array("status" => "failed", "data" => array());
	
	$row_id = $_POST["row"];
	if ($row_id) {
		$q = "
			SELECT M.*, 
			(SELECT ROW.name FROM `osc_wh_rows` AS ROW WHERE ROW.id = M.row_id LIMIT 1) AS row_name, 
			(SELECT ROW.rack_id FROM `osc_wh_rows` AS ROW WHERE ROW.id = M.row_id LIMIT 1) AS rack_id, 
			(SELECT RACK.name FROM `osc_wh_racks` AS RACK WHERE RACK.id = rack_id LIMIT 1) AS rack_name
			FROM `osc_wh_sections` AS M WHERE M.row_id = '$row_id'
		";
		$sections = $ah->rs($q);
		if ($sections) {
			$response["data"] = $sections;
			$response["status"] = "success";
		}
	}

	echo json_encode($response); exit();
?>