<?php 
	$appTable = $_POST['appTable'];
	$item_id = $_POST['item_id'];
	$cardUpd = array(
				'name'			=> $_POST['name'],
				//'alias'			=> $_POST['alias'],
				'rack_id'	=> (int)$_POST['rack_id'],
				'size_x'	=> (int)$_POST['size_x'],
				'size_y'	=> (int)$_POST['size_y'],
				'description'	=> $_POST['description'],
				'block'			=> $_POST['block'][0],
				
				'modified'	=> date("Y-m-d H:i:s", time())
					);

	
	$rack_id = (int)$_POST['rack_id'];

	
	if(strlen($_POST['name'])>0){
		if($rack_id){
			$query = "UPDATE `osc_wh_rows` SET ";
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
			$data['message'] = "Select rack from list.";
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Enter row name.";
	}
	
	