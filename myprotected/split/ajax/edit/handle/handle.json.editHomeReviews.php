<?php 	//********************	//** WEB MIRACLE TECHNOLOGIES	//********************		// get post		$appTable = $_POST['appTable'];		$item_id = 1;		$lpx = $_POST['lpx'];	$lang_prefix = ($lpx ? $lpx."_" : ""); // (Israel - empty, ru, en, fr)		$cardUpd = array(					$lang_prefix.'title'	=> $_POST['title'],										'dateModify'	=> date("Y-m-d H:i:s", time())					);						// Update main table		$query = "UPDATE `$appTable` SET ";		$cntUpd = 0;	foreach($cardUpd as $field => $itemUpd)	{		$cntUpd++;		$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");	}		$query .= " WHERE `id`=$item_id LIMIT 1";				$ah->rs($query,0,1);		$data['message'] = "Home Reviews saved successfully.";	