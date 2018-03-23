<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);
	$lang_fields = json_decode($_POST['av_langs']);
	if ($_POST['order_id'] == '' || preg_match('/[a-z]+/i',$_POST['order_id'])) {
		$order_id = 0;
	}else{
		$order_id = $_POST['order_id'];
	}
	$cardUpd = array(
					'title'			=> $_POST['title'],
					'description'	=> $_POST['description'],
					
					'order'			=> $_POST['order'],
					'publish'		=> $_POST['publish'][0],
					
					'price'			=> $_POST['price'],
					'rent_price'	=> $_POST['rent_price'],
					
					'created'	=> date("Y-m-d H:i:s", time()),
					'modified'	=> date("Y-m-d H:i:s", time())
					);

	foreach ($lang_fields as $key) {

		$ind = (string)$key->alias.'_description';
		$lang_tmp = array($ind => (string)$_POST['description']);
		$cardUpd = array_merge($cardUpd, $lang_tmp);


		$ind2 = (string)$key->alias.'_title';
		$lang_tmp2 = array($ind2 => (string)$_POST['title']);
		$cardUpd = array_merge($cardUpd, $lang_tmp2);

	}


					
	// File upload 
	
	$filename = "image";

	if(isset($_FILES[$filename]) && $_FILES[$filename]['size'] > 0)
	{
		$file_path = "../../../../split/files/content/";

		if (strlen($cardUpd['file']) > 0) {
			$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>4, //4
				'pre'			=>$cardUpd['image'], // name
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
				'pre'			=>"pack_", // name
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
		
	$ah->rs($query);
	
	$item_id = mysql_insert_id();
	
	if($item_id)
	{
		$data['item_id'] = $item_id;
	}else
	{
		$data['item_id'] = 0;
	}
	
	$data['message'] = "Новый материал успешно создан.";
	