<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);

	$lpx = $_POST['lpx'];

	$lang_prefix = ($lpx ? $lpx."_" : ""); // (Israel - empty, ru, en, fr)
	
	$cardUpd = array(
					$lang_prefix.'title'	=> $_POST['title'],
					$lang_prefix.'details'	=> $_POST['details'],
					$lang_prefix.'caption'	=> $_POST['caption'],
					
					'block'			=> (int)$_POST['block'][0],
					'order_id'		=> (int)$_POST['order_id'],
					
					
					'box_contains'		=> (int)$_POST['box_contains'][0],
					'pack_list'			=> (int)$_POST['pack_list'][0],
					'contacts_view'		=> (int)$_POST['contacts_view'][0],
					'isra_gal'			=> (int)$_POST['isra_gal'][0],
					
					'table_id'			=> (int)$_POST['table_id'],
					'paral_id'			=> (int)$_POST['paral_id'],
					
					
					's1'			=> (int)$_POST['s1'][0],					
					's1_gal_id'		=> (int)$_POST['s1_gal_id'],
					's1_paral_id'	=> (int)$_POST['s1_paral_id'],
					$lang_prefix.'s1_title'		=> $_POST['s1_title'],
					$lang_prefix.'s1_details'	=> $_POST['s1_details'],
					
					
					's2'			=> (int)$_POST['s2'][0],					
					's2_gal_id'		=> (int)$_POST['s2_gal_id'],
					's2_paral_id'	=> (int)$_POST['s2_paral_id'],
					's2_table_id'	=> (int)$_POST['s2_table_id'],
					
					'meta_title'	=> $_POST['meta_title'],
					'meta_keys' 	=> $_POST['meta_keys'],
					'meta_desc' 	=> $_POST['meta_desc'],
					
					
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);
					
	// File upload 
	
	$filename = "image";
	
	if(isset($_FILES[$filename]) && $_FILES[$filename]['size'] > 0)
	{
		$file_path = "../../../../split/files/content/";
		
		$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>5,
				'pre'			=>"service_",
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$filename
			  ));
		if($file_update)
		{
			$cardUpd[$filename] = $file_update;
			
			$curr_filename = $_POST['curr_filename'];
			
			unlink($file_path.$curr_filename);
		}
	}
					
	// Update main table
	
	$query = "UPDATE [pre]$appTable SET ";
	
	$cntUpd = 0;
	foreach($cardUpd as $field => $itemUpd)
	{
		$cntUpd++;
		$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");
	}
	
	$query .= " WHERE `id`=$item_id LIMIT 1";
			
	$ah->rs($query,0,1);
	
	$data['message'] = "Page Services Item saved successfully.";
	