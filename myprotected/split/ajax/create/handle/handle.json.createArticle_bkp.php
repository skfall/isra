<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post

	$lang_fields = $ah->getAvailableLangs();
	
	$appTable = $_POST['appTable'];
	
	$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);
	
	
	$cardUpd = array(
					'name'			=> strip_tags(trim($_POST['name'])),
					'alias'			=> $_POST['alias'],
					'cat_id'		=> $_POST['cat_id'],
					'gal_orient'			=> $_POST['gal_orient'][0],
					
					'order_id'		=> (int)$_POST['order_id'],
					'block'			=> $_POST['block'][0],
					'popular'		=> $_POST['popular'][0],

					'google_play'	=> strip_tags(trim($_POST['google_play'])),
					'app_store'		=> strip_tags(trim($_POST['app_store'])),
					'pc'			=> strip_tags(trim($_POST['pc'])),
					'mac'			=> strip_tags(trim($_POST['mac'])),

					'target'		=> $_POST['target'][0],



					'content'		=> $_POST['content'],

					
					'gallery_id'	=> $_POST['gallery_id'],

					'dateCreate'	=> date("Y-m-d H:i:s", time()),
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);


					

	foreach ($lang_fields as $key) {

		$ind = (string)$key['alias'].'_name';
		$lang_tmp = array($ind => (string)$_POST['name']);
		$cardUpd = array_merge($cardUpd, $lang_tmp);


		$ind2 = (string)$key['alias'].'_content';
		$lang_tmp2 = array($ind2 => (string)$_POST['content']);
		$cardUpd = array_merge($cardUpd, $lang_tmp2);

	}
	// echo '<pre>'; print_r($cardUpd); echo '</pre>'; exit();
	
	// File upload filename

	$file_path = "../../../../split/files/images/";

	// PREVIEW ------------------
	$im_1_filename = "fl_name_preview";

	$im_1 		= false;
	$im_1_name 	= 5;
	$im_1_pre 	= "artc_";
	
	if(isset($_FILES[$im_1_filename]) && $_FILES[$im_1_filename]['size'] > 0)
	{
		if (strlen($_POST['fl_name_preview_hd']) > 0) {

			$ext = explode('.', $_FILES[$im_1_filename]['name']);
			$ext = $ext[1];
			$new_name = str_replace(' ', '_', $_POST['fl_name_preview_hd']).'.'.$ext;

			if (file_exists($file_path.$new_name)) {
				$data['status'] = "failed";
				$data['message'] = "Изображение превью с таким именем уже существует";
				echo json_encode($data);
				exit();
			}

			$im_1 		= true;
			$im_1_name 	= 4;
			$im_1_pre 	= str_replace(' ', '_', $_POST['fl_name_preview_hd']);
			
		}else{
			$im_1 = true;
		}
	}
	// File upload plan_image
	

	// BANNER -----------------
	$im_2_filename = "fl_name_banner";

	$im_2 		= false;
	$im_2_name 	= 5;
	$im_2_pre 	= "artc_";
	
	if(isset($_FILES[$im_2_filename]) && $_FILES[$im_2_filename]['size'] > 0)
	{	
		if (strlen($_POST['fl_name_banner_hd']) > 0) {

			$ext = explode('.', $_FILES[$im_2_filename]['name']);
			$ext = $ext[1];
			$new_name = str_replace(' ', '_', $_POST['fl_name_banner_hd']).'.'.$ext;
			
			if (file_exists($file_path.$new_name)) {
				$data['status'] = "failed";
				$data['message'] = "Изображение баннера с таким именем уже существует";
				echo json_encode($data);
				exit();
			}

			$im_2 		= true;
			$im_2_name 	= 4;
			$im_2_pre 	= str_replace(' ', '_', $_POST['fl_name_banner_hd']);

		}else{
			$im_2 = true;
		}
	}

	// TOP IMAGE -----------------
	$im_3_filename = "fl_name_top_img";

	$im_3 		= false;
	$im_3_name 	= 5;
	$im_3_pre 	= "artc_";
	
	if(isset($_FILES[$im_3_filename]) && $_FILES[$im_3_filename]['size'] > 0)
	{
		$file_path = "../../../../split/files/images/";
		
		if (strlen($_POST['fl_name_top_img_hd']) > 0) {

			$ext = explode('.', $_FILES[$im_3_filename]['name']);
			$ext = $ext[1];
			$new_name = str_replace(' ', '_', $_POST['fl_name_top_img_hd']).'.'.$ext;

			
			if (file_exists($file_path.$new_name)) {
				$data['status'] = "failed";
				$data['message'] = "Верхнее изображение с таким именем уже существует";
				echo json_encode($data);
				exit();
			}

			$im_3 		= true;
			$im_3_name 	= 4;
			$im_3_pre 	= str_replace(' ', '_', $_POST['fl_name_top_img_hd']);

		}else{
			$im_3 = true;
		}
	}


	// BOT IMAGE -----------------
	$im_4_filename = "fl_name_bot_img";

	$im_4 		= false;
	$im_4_name 	= 5;
	$im_4_pre 	= "artc_";
	
	if(isset($_FILES[$im_4_filename]) && $_FILES[$im_4_filename]['size'] > 0)
	{
		$file_path = "../../../../split/files/images/";
		
		if (strlen($_POST['fl_name_bot_img_hd']) > 0) {

			$ext = explode('.', $_FILES[$im_4_filename]['name']);
			$ext = $ext[1];
			$new_name = str_replace(' ', '_', $_POST['fl_name_bot_img_hd']).'.'.$ext;
			
			if (file_exists($file_path.$new_name)) {
				$data['status'] = "failed";
				$data['message'] = "Нижнее изображение с таким именем уже существует";
				echo json_encode($data);
				exit();
			}

			$im_4 		= true;
			$im_4_name 	= 4;
			$im_4_pre 	= str_replace(' ', '_', $_POST['fl_name_bot_img_hd']);

		}else{
			$im_4 = true;
		}
	}

	// MODAL IMAGE -----------------
	$im_5_filename = "fl_name_modal";

	$im_5 		= false;
	$im_5_name 	= 5;
	$im_5_pre 	= "artc_";
	
	if(isset($_FILES[$im_5_filename]) && $_FILES[$im_5_filename]['size'] > 0)
	{
		$file_path = "../../../../split/files/images/";
		
		if (strlen($_POST['fl_name_modal_hd']) > 0) {

			$ext = explode('.', $_FILES[$im_5_filename]['name']);
			$ext = $ext[1];
			$new_name = str_replace(' ', '_', $_POST['fl_name_modal_hd']).'.'.$ext;
			
			if (file_exists($file_path.$new_name)) {
				$data['status'] = "failed";
				$data['message'] = "Изображение модального окна с таким именем уже существует";
				echo json_encode($data);
				exit();
			}

			$im_5 		= true;
			$im_5_name 	= 4;
			$im_5_pre 	= str_replace(' ', '_', $_POST['fl_name_modal_hd']);

		}else{
			$im_5 = true;
		}
	}


	// END OF IMAGES UPLOADS

	if($im_1)
	{
		$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>$im_1_name,
				'pre'			=>$im_1_pre,
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$im_1_filename,
				'resize_path'	=>$file_path."crop/",
				'resize_w'		=>466,
				'resize_h'		=>363,
				'resize_path_2'	=>"0",
				'resize_w_2'	=>0,
				'resize_h_2'	=>0
			  ));
		if($file_update)
		{
			$cardUpd[$im_1_filename] = $file_update;
		}
	}

	if($im_2)
	{
		$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>$im_2_name,
				'pre'			=>$im_2_pre,
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$im_2_filename,
				'resize_path'	=>$file_path."crop/",
				'resize_w'		=>466,
				'resize_h'		=>363,
				'resize_path_2'	=>"0",
				'resize_w_2'	=>0,
				'resize_h_2'	=>0
			  ));
		if($file_update)
		{
			$cardUpd[$im_2_filename] = $file_update;
		}
	}

	if($im_3)
	{
		$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>$im_3_name,
				'pre'			=>$im_3_pre,
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$im_3_filename,
				'resize_path'	=>$file_path."crop/",
				'resize_w'		=>466,
				'resize_h'		=>363,
				'resize_path_2'	=>"0",
				'resize_w_2'	=>0,
				'resize_h_2'	=>0
			  ));
		if($file_update)
		{
			$cardUpd[$im_3_filename] = $file_update;
		}
	}

	if($im_4)
	{
		$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>$im_4_name,
				'pre'			=>$im_4_pre,
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$im_4_filename,
				'resize_path'	=>$file_path."crop/",
				'resize_w'		=>466,
				'resize_h'		=>363,
				'resize_path_2'	=>"0",
				'resize_w_2'	=>0,
				'resize_h_2'	=>0
			  ));
		if($file_update)
		{
			$cardUpd[$im_4_filename] = $file_update;
		}
	}

	if($im_5)
	{
		$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>$im_5_name,
				'pre'			=>$im_5_pre,
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$im_5_filename
			  ));
		if($file_update)
		{
			$cardUpd[$im_5_filename] = $file_update;
		}
	}

	// Main query INSERT START

	
	$query = "SELECT id FROM [pre]articles WHERE `alias`='".$cardUpd['alias']."' LIMIT 1";
	$test_alias = $ah->rs($query);
	
	if(strlen($cardUpd['name'])>1)
	{
		if(!$test_alias)
		{
	
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

				if ($item_id) {
					$data['message'] = "Новый материал успешно создан.";
				}


				$alt_arr = array(
					'alt_preview'	=> $_POST['alt_preview'],
					'title_preview'	=> $_POST['title_preview'],

					'alt_banner'	=> $_POST['alt_banner'],
					'title_banner'	=> $_POST['title_banner'],

					'alt_top_img'	=> $_POST['alt_top_img'],
					'title_top_img'	=> $_POST['title_top_img'],

					'alt_bot_img'	=> $_POST['alt_bot_img'],
					'title_bot_img'	=> $_POST['title_bot_img'],

					'alt_modal'		=> $_POST['alt_modal'],
					'title_modal'	=> $_POST['title_modal'],

					'meta_title'	=> $_POST['meta_title'],
					'meta_desc'		=> $_POST['meta_desc'],
					'meta_keys'		=> $_POST['meta_keys']
				);
				$alt_arr = addslashes(json_encode($alt_arr));

				$query_array = array(
					'art_id' => $item_id,
					'data' => $alt_arr
				);

				foreach ($lang_fields as $key) {
					$ind = (string)$key['alias'].'_data';
					$lang_tmp = array($ind => $alt_arr);
					$query_array = array_merge($query_array, $lang_tmp);
				}


				if ($item_id) {
					$query = "INSERT INTO [pre]article_images_alts ";
					$fieldsStr = " ( ";
					$valuesStr = " ( ";
					$cntUpd = 0;
					foreach($query_array as $field => $itemUpd)
					{
						$cntUpd++;
						
						$fieldsStr .= ($cntUpd==1 ? "`$field`" : ", `$field`");
						
						$valuesStr .= ($cntUpd==1 ? "'$itemUpd'" : ", '$itemUpd'");
					}
					$fieldsStr .= " ) ";
					$valuesStr .= " ) ";
					$query .= $fieldsStr." VALUES ".$valuesStr;
				
					$ah->rs($query);
				}

				
				if($item_id)
				{
					$data['item_id'] = $item_id;
					
					// Upload files
				
					$filename = "docs";
					
					if(isset($_FILES[$filename]) && count($_FILES[$filename]) > 0)
					{
						$file_path = "../../../../split/files/documents/";
						
						$files_upload = $ah->mtvc_add_files_file_miltiple(array(
								'path'			=>$file_path,
								'name'			=>5,
								'pre'			=>"doc_",
								'size'			=>20,
								'rule'			=>0,
								'max_w'			=>2500,
								'max_h'			=>2500,
								'files'			=>$filename
							  ));
						if($files_upload)
						{
							foreach($files_upload as $file_upload)
							{
								$query = "INSERT INTO [pre]docs_ref (`ref_table`, `ref_id`, `file`, `crop`, `path`) VALUES ('articles', '$item_id', '$file_upload', '0', 'split/files/documents/')";
								
								$ah->rs($query);
							}
						}


					}
				}else
				{
					$data['item_id'] = 0;
				}
		}else{
			$data['status'] = "failed";
			$data['message'] = "Материал с таким Алиасом уже существует";
			}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Укажите Название материала";
		}
	

