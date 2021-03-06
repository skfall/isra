<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);
	
	$cardUpd = array(
					'title'			=> $_POST['title'],
					'details'		=> $_POST['caption'],
					'details'		=> $_POST['details'],
					'block'			=> (int)$_POST['block'][0],
					'order_id'		=> (int)$_POST['order_id'],
					
					'meta_title'	=> $_POST['meta_title'],
					'meta_keys' 	=> $_POST['meta_keys'],
					'meta_desc' 	=> $_POST['meta_desc'],
					
					'dateCreate'	=> date("Y-m-d H:i:s", time()),
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);
	
	// File upload 
	
	$filename = "image";

	if(isset($_FILES[$filename]) && $_FILES[$filename]['size'] > 0)
	{
		$file_path = "../../../../split/files/content/";

		if (strlen($cardUpd['file']) > 0) {
			$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>4, //4
				'pre'			=>$cardUpd['file'], // name
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$filename
			  ));
			if($file_update)
			{
				$cardUpd[$filename] = $file_update;
			}
		}else{
			$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>5, //4
				'pre'			=>"service_", // name
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$filename
			  ));
			if($file_update)
			{
				$cardUpd[$filename] = $file_update;
			}
		}
		
	}
	
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
		
	$item_id = $ah->rs($query,0,0,1);
	
	if($item_id)
	{
		$data['item_id'] = $item_id;
	}else
	{
		$data['item_id'] = 0;
	}
	
	$data['message'] = "Новый Page Services Item успешно создан.";
	