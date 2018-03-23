<?php 
	$appTable = $_POST['appTable'];
	$item_id = $_POST['item_id'];
	$cardUpd = array(
					'alias'		=> $_POST['alias'],
					'name'		=> $_POST['name'],
					'description'	=> $_POST['description'],
					'pos'		=> (int)$_POST['pos'],
					'block'			=> $_POST['block'][0],
					'modified'	=> date("Y-m-d H:i:s", time())
					);

	
	$query = "SELECT id FROM `osc_wh_warehouses` WHERE `alias`='".$cardUpd['alias']."' AND `id`!=$item_id LIMIT 1";
	$test_alias = $ah->rs($query);

	if(strlen($_POST['name'])>1){
		if(!$test_alias){
			$query = "UPDATE `osc_wh_warehouses` SET ";
			$cntUpd = 0;
			foreach($cardUpd as $field => $itemUpd) {
				$cntUpd++;
				$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");
			}
			$query .= " WHERE `id`=$item_id LIMIT 1";
			$ah->rs($query);

			$data['message'] = "Warehouse was successfully updated.";
			$data['status'] = "success";
		}else{
			$data['status'] = "failed";
			$data['message'] = "Warehouse with this alias is already exists.";
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Enter warehouse name.";
	}
	
	