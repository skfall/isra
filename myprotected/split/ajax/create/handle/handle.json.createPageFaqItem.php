<?php 	//********************	//** WEB MIRACLE TECHNOLOGIES	//********************		// get post		$appTable = $_POST['appTable'];		$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);		$cardUpd = array(					'title'			=> $_POST['title'],					'details'		=> $_POST['details'],					'block'			=> (int)$_POST['block'][0],					'order_id'		=> (int)$_POST['order_id'],										'dateCreate'	=> date("Y-m-d H:i:s", time()),					'dateModify'	=> date("Y-m-d H:i:s", time())					);		// Create main table item		$query = "INSERT INTO [pre]$appTable ";		$fieldsStr = " ( ";		$valuesStr = " ( ";		$cntUpd = 0;	foreach($cardUpd as $field => $itemUpd)	{		$cntUpd++;				$fieldsStr .= ($cntUpd==1 ? "`$field`" : ", `$field`");				$valuesStr .= ($cntUpd==1 ? "'$itemUpd'" : ", '$itemUpd'");	}		$fieldsStr .= " ) ";		$valuesStr .= " ) ";		$query .= $fieldsStr." VALUES ".$valuesStr;			$item_id = $ah->rs($query,0,0,1);		if($item_id)	{		$data['item_id'] = $item_id;	}else	{		$data['item_id'] = 0;	}		$data['message'] = "Новый FAQ Item успешно создан.";	