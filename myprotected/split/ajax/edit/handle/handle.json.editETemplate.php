<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$lpx = $_POST['lpx'];

	$lang_prefix = ($lpx ? $lpx."_" : ""); // empty = iw

	$item_id = $_POST['item_id'];

    $cardUpd = array(
        'name'	    	=> $_POST['name'],
        $lang_prefix.'subject'	    => $_POST['subject'],
        $lang_prefix.'body'	        => $_POST['body'],
        'email_from'    => $_POST['email_from']
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
		
	// echo "<pre>"; echo str_replace("[pre]","osc_",$query); echo "</pre>"; exit();

	$data['query'] = $query;

	$ah->rs($query);

	$data['message'] = "Query Success.";
    $data['status'] = 'success';