<?php 
	$appTable = $_POST['appTable'];
	$item_id = $_POST['item_id'];
	$cardUpd = array(
				'name'			=> $_POST['name'],
				//'alias'			=> $_POST['alias'],
				'row_id'	=> (int)$_POST['row_id'],
				'size_x'	=> (int)$_POST['size_x'],
				'description'	=> $_POST['description'],
				'block'			=> $_POST['block'][0],
				'modified'	=> date("Y-m-d H:i:s", time())
					);

	
	$row_id = (int)$_POST['row_id'];

	
	if(strlen($_POST['name'])>0){
		if($row_id) {
			$curr_size = (int)$_POST["size_x"];
			$q = "SELECT M.size_x FROM `osc_wh_rows` AS M WHERE M.id = '$row_id' LIMIT 1";
			$available_size = $ah->rs($q);
			$available_size = (int)$available_size[0]["size_x"];

			$q = "SELECT SUM(size_x) AS total_size_sum FROM `osc_wh_sections` WHERE row_id = '$row_id' AND id != '$item_id'";
			$other_sections_size = $ah->rs($q);
			$other_sections_size = (int)$other_sections_size[0]["total_size_sum"];

			$available_size -= $other_sections_size;
			$diff = $available_size - $curr_size;

			if ($diff >= 0) {
				$query = "UPDATE `osc_wh_sections` SET ";
				$cntUpd = 0;
				foreach($cardUpd as $field => $itemUpd) {
					$cntUpd++;
					$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");
				}
				$query .= " WHERE `id`=$item_id LIMIT 1";
				$ah->rs($query);

				$data['message'] = "Section was successfully updated.";
				$data['status'] = "success";
			}else{
				$data['status'] = "failed";
				$data['message'] = "There is no space for this section in selected row. Available space: ".$available_size." shelves.";
			}
			
		}else{
			$data['status'] = "failed";
			$data['message'] = "Select row from list.";
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Enter section name.";
	}
	
	