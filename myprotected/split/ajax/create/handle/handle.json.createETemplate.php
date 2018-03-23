<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);

    $cardUpd = array(
                    'name'	        => $_POST['name'],
                    'subject'	    => $_POST['subject'],
                    'body'	        => $_POST['body'],
                    'email_from'    => $_POST['email_from']
                    );
	
	// Create main table item

    $query = "INSERT INTO [pre]$appTable ";

    $fieldsStr = " ( ";

    $valuesStr = " ( ";

    $cntUpd = 0;
    foreach($cardUpd as $field => $itemUpd)
    {
        $cntUpd++;

        $fieldsStr .= ($cntUpd==1 ? "`$field`" : ", `$field`");

        $valuesStr .= ($cntUpd==1 ? "'$itemUpd'" : ", '$itemUpd'");
    }

    $fieldsStr .= " ) ";

    $valuesStr .= " ) ";

    $query .= $fieldsStr." VALUES ".$valuesStr;

    $ah->rs($query);

    $item_id = mysql_insert_id();
    $item_id = $ah->rs($query,0,0,1);
    
    if($item_id)
    {
        $data['item_id'] = $item_id;
    }else
    {
        $data['item_id'] = 0;
    }
    
    $data['message'] = "Шаблон создан";

	

	