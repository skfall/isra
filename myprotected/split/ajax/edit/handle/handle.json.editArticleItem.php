<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$lpx = $_POST['lpx'];

	$lang_prefix = ($lpx ? $lpx."_" : ""); // empty = en

	$query = "SELECT `alias`, `fl_name_preview` FROM [pre]articles WHERE `id`='$item_id' LIMIT 1";
	$alias = $ah->rs($query);

	$old_prev_fn = $alias[0]['fl_name_preview'];

	if ($_POST['order_id'] == '' || preg_match('/[a-z]+/i',$_POST['order_id'])) {
		$order_id = 0;
	}else{
		$order_id = $_POST['order_id'];
	}


	$cardUpd = array(
					$lang_prefix.'name'	=> strip_tags(trim($_POST['name'])),
					
					'alias'		=> $_POST['alias'],
					'cat_id'		=> $_POST['cat_id'],
					
					'block'			=> $_POST['block'][0],
					
					$lang_prefix.'preview'	=> strip_tags(trim($_POST['preview'])),
					$lang_prefix.'content'	=> $_POST['content'],

					//'gallery_id'	=> $_POST['gallery_id'],									
					
					'dateModify'	=> date("Y-m-d", strtotime($_POST['dateModify']))
					);

	// echo '<pre>'; print_r($cardUpd); echo '</pre>'; exit();
	/*
	if ($lpx == "en") {
		$cardUpd = array_merge($cardUpd, array('alias'	=> $_POST['alias']));
	}else{
		$cardUpd['alias'] = $alias[0]['alias'];
	}
	*/
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
	elseif (strlen($_POST['fl_name_preview_hd']) > 0) {
		$ext = explode('.', $old_prev_fn);
		$ext = $ext[1];
		$new_name = str_replace(' ', '_', $_POST['fl_name_preview_hd']).'.'.$ext;
		$cardUpd[$im_1_filename] = $new_name;

		if(!file_exists($file_path.$new_name)){
			rename($file_path.$old_prev_fn, $file_path.$new_name);
			rename($file_path.'crop/640x320_'.$old_prev_fn, $file_path.'crop/640x320_'.$new_name);
		}else{
			$data['status'] = "failed";
			$data['message'] = "Изображение превью нельзя переименовать по указанному значению";
			echo json_encode($data);
			exit();
		}
	}

	// END OF IMAGES UPLOADS

	if($im_1)
	{
		$file_update = false;
		
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

			if (explode('.', $old_prev_fn)[0] != $_POST['fl_name_preview_hd']) {
				unlink($file_path.$old_prev_fn);
				unlink($file_path.'crop/640x320_'.$old_prev_fn);
			}
			
		}
	}

	// Main query update START

	
	$query = "SELECT id FROM [pre]articles WHERE `alias`='".$cardUpd['alias']."' AND `id`!=$item_id LIMIT 1";

	$test_alias = $ah->rs($query);


	
	if(strlen($_POST['name'])>1)
	{
		if(!$test_alias)
		{

			// UPDATE ALT AND TITLE AND META!!! TABLE

			// mysql_real_escape_string()

			$alt_arr = array(
				'alt_preview'	=> $_POST['alt_preview'],
				'title_preview'	=> $_POST['title_preview'],

				'meta_title'	=> $_POST['meta_title'],
				'meta_desc'		=> $_POST['meta_desc'],
				'meta_keys'		=> $_POST['meta_keys']
			);
			$alt_arr = addslashes(json_encode($alt_arr));

			$query = "
				UPDATE [pre]article_images_alts
				SET `".$lang_prefix."data` = '$alt_arr'
				WHERE `art_id` = $item_id 
				LIMIT 1
			";

			$ah->rs($query);
		

			
			$query = "UPDATE [pre]$appTable SET ";
			
			$cntUpd = 0;
			foreach($cardUpd as $field => $itemUpd)
			{
				$cntUpd++;
				$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");
			}
			
			$query .= " WHERE `id`=$item_id LIMIT 1";
			
			$ah->rs($query);
			
			
		}else{
			$data['status'] = "failed";
			$data['message'] = "Материал с таким Алиасом уже существует";
			}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Укажите Название материала";
		}
	
	$data['message'] = "Материал успешно сохранен.";
	