<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];

	$lpx = $_POST['lpx'];

	$lang_prefix = ($lpx ? $lpx."_" : ""); // empty = en
	
	$cardUpd = array(
					$lang_prefix.'q'		=> $_POST['q'],
					$lang_prefix.'a'		=> $_POST['a'],
					'block'			=> $_POST['block'][0],
					'order_id'		=> $_POST['order_id'],
					
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);
						
	// Update main table
	
	$query = "UPDATE [pre]$appTable SET ";
	
	$cntUpd = 0;
	foreach($cardUpd as $field => $itemUpd)
	{
		$cntUpd++;
		$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");
	}
	
	$query .= " WHERE `id`=$item_id LIMIT 1";
			
	$ah->rs($query);
	
	$data['message'] = "Privacy #$item_id успешно сохранен.";
	