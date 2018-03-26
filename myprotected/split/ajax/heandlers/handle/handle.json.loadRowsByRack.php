<?php 
	$response = array("status" => "failed", "data" => array());
	
	$rack_id = $_POST["rack"];
	if ($rack_id) {
		$q = "
			SELECT M.*, 
			(SELECT RACK.name FROM `osc_wh_racks` AS RACK WHERE RACK.id = M.rack_id LIMIT 1) AS rack_name 
			FROM `osc_wh_rows` AS M WHERE M.rack_id = '$rack_id'
		";
		$rows = $ah->rs($q);
		if ($rows) {
			foreach ($rows as $key => &$row) {
				$row_id = $row['id'];
				$curr_size = (int)$row["size_x"];
				$q = "SELECT SUM(size_x) AS total_size_sum FROM `osc_wh_sections` WHERE row_id = '$row_id'";
				$row["available_size"] = $curr_size - ((int)$ah->rs($q)[0]["total_size_sum"]);
			}
			$response["data"] = $rows;
			$response["status"] = "success";
		}
	}

	echo json_encode($response); exit();
?>