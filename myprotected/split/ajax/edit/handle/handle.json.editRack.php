<?php 
	$appTable = $_POST['appTable'];
	$item_id = $_POST['item_id'];
	$cardUpd = array(
				'name'			=> $_POST['name'],
				'alias'			=> $_POST['alias'],
				'warehouse_id'	=> (int)$_POST['warehouse_id'],
				'description'	=> $_POST['description'],
				'block'			=> $_POST['block'][0],
				'pos'			=> (int)$_POST['pos'],
				'modified'	=> date("Y-m-d H:i:s", time())
					);

	
	$query = "SELECT id FROM `osc_wh_racks` WHERE `alias`='".$cardUpd['alias']."' AND `id`!=$item_id LIMIT 1";
	$test_alias = $ah->rs($query);

	if(strlen($_POST['name'])>1){
		if(!$test_alias){
			if ($cardUpd['warehouse_id']) {
				$query = "UPDATE `osc_wh_racks` SET ";
				$cntUpd = 0;
				foreach($cardUpd as $field => $itemUpd) {
					$cntUpd++;
					$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");
				}
				$query .= " WHERE `id`=$item_id LIMIT 1";
				$ah->rs($query);

				$data['message'] = "Rack was successfully updated.";
				$data['status'] = "success";
			}else{
				$data['status'] = "failed";
				$data['message'] = "Select warehouse from list.";
			}
		}else{
			$data['status'] = "failed";
			$data['message'] = "Rack with this alias is already exists.";
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Enter rack name.";
	}
	
	