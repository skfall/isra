<?php 	//********************	//** WEB MIRACLE TECHNOLOGIES	//********************		// get post		$appTable = $_POST['appTable'];		$item_id = $_POST['item_id'];		$cardUpd = array(										'article'			=> $_POST['article'],					'order_id'			=> (int)$_POST['order_id'],					);		// Update main table		$query = "UPDATE [pre]$appTable SET ";		$cntUpd = 0;	foreach($cardUpd as $field => $itemUpd)	{		$cntUpd++;		$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");	}		$query .= " WHERE `id`=$item_id LIMIT 1";				$ah->rs($query);		$data['q'] = $query;	$data['status'] = 'success';	$data['message'] = "VIRTUAL BOX успешно сохранен.";	