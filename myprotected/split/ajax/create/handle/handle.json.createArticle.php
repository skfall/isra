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
					
					'block'			=> $_POST['block'][0],
					
					'preview'		=> strip_tags(trim($_POST['preview'])),
					'content'		=> $_POST['content'],
					
					//'gallery_id'	=> $_POST['gallery_id'],

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
				'resize_w'		=>640,
				'resize_h'		=>320,
				'resize_path_2'	=>"0",
				'resize_w_2'	=>0,
				'resize_h_2'	=>0
			  ));
		if($file_update)
		{
			$cardUpd[$im_1_filename] = $file_update;
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

				$item_id = $ah->rs($query,0,1,1);	

				if ($item_id) {
					
					$data['item_id'] = $item_id;
					
					$data['message'] = "Новый материал успешно создан.";


					$alt_arr = array(
						'alt_preview'	=> $_POST['alt_preview'],
						'title_preview'	=> $_POST['title_preview'],
						
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
				}

				else
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
	

