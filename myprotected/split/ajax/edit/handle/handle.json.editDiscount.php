<?php 	//********************	//** WEB MIRACLE TECHNOLOGIES	//********************		// get post		$appTable = $_POST['appTable'];		$item_id = $_POST['item_id'];		$cardUpd = array(										'code'			=> $_POST['code'],					'value'			=> (int)$_POST['value'],										'expires'			=> date("Y-m-d H:i:s",strtotime($_POST['expires'])),										'user_for'			=> (int)$_POST['user_for'],					'reusable'			=> (int)$_POST['reusable'][0],					'modified'			=> date("Y-m-d H:i:s")					);		// Update main table		$query = "UPDATE [pre]$appTable SET ";		$cntUpd = 0;	foreach($cardUpd as $field => $itemUpd)	{		$cntUpd++;		$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");	}		$query .= " WHERE `id`=$item_id LIMIT 1";				$ah->rs($query);		$data['q'] = $query;	$data['status'] = 'success';	$data['message'] = "VIRTUAL BOX успешно сохранен.";	