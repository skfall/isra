<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$lpx = $_POST['lpx'];

	$lang_prefix = ($lpx ? $lpx."_" : ""); // empty = en

	$query = "SELECT `alias`, `fl_name_preview`, `fl_name_banner`, `fl_name_top_img`, `fl_name_bot_img`, `fl_name_modal`  FROM [pre]articles WHERE `id`='$item_id' LIMIT 1";
	$alias = $ah->rs($query);

	$old_prev_fn = $alias[0]['fl_name_preview'];
	$old_ban_fn = $alias[0]['fl_name_banner'];
	$old_top_fn = $alias[0]['fl_name_top_img'];
	$old_bot_fn = $alias[0]['fl_name_bot_img'];
	$old_modal_fn = $alias[0]['fl_name_modal'];

	if ($_POST['order_id'] == '' || preg_match('/[a-z]+/i',$_POST['order_id'])) {
		$order_id = 0;
	}else{
		$order_id = $_POST['order_id'];
	}


	$cardUpd = array(
					$lang_prefix.'name'	=> strip_tags(trim($_POST['name'])),
					
					
					'cat_id'		=> $_POST['cat_id'],
					
					'order_id'		=> (int)$order_id,
					'block'			=> $_POST['block'][0],
					'popular'		=> $_POST['popular'][0],
					
					'google_play'	=> strip_tags(trim($_POST['google_play'])),
					'app_store'		=> strip_tags(trim($_POST['app_store'])),
					'pc'			=> strip_tags(trim($_POST['pc'])),
					'mac'			=> strip_tags(trim($_POST['mac'])),

					'gal_orient'	=> $_POST['gal_orient'][0],
					'target'		=> $_POST['target'][0],

					$lang_prefix.'content'		=> $_POST['content'],

					'gallery_id'	=> $_POST['gallery_id'],

					'dateCreate'	=> date("Y-m-d H:i:s", time()),
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);

	// echo '<pre>'; print_r($cardUpd); echo '</pre>'; exit();

	if ($lpx == "") {
		$cardUpd = array_merge($cardUpd, array('alias'			=> $_POST['alias']));
	}else{
		$cardUpd['alias'] = $alias[0]['alias'];
	}

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
			rename($file_path.'crop/466x363_'.$old_prev_fn, $file_path.'crop/466x363_'.$new_name);
		}else{
			$data['status'] = "failed";
			$data['message'] = "Изображение превью нельзя переименовать по указанному значению";
			echo json_encode($data);
			exit();
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
	elseif (strlen($_POST['fl_name_banner_hd']) > 0) {
		$ext = explode('.', $old_ban_fn);
		$ext = $ext[1];
		$new_name = str_replace(' ', '_', $_POST['fl_name_banner_hd']).'.'.$ext;
		$cardUpd[$im_2_filename] = $new_name;

		if(!file_exists($file_path.$new_name)){
			rename($file_path.$old_ban_fn, $file_path.$new_name);
			rename($file_path.'crop/466x363_'.$old_ban_fn, $file_path.'crop/466x363_'.$new_name);
		}else{
			$data['status'] = "failed";
			$data['message'] = "Изображение баннера нельзя переименовать по указанному значению";
			echo json_encode($data);
			exit();
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
	}elseif (strlen($_POST['fl_name_top_img_hd']) > 0) {
		$ext = explode('.', $old_top_fn);
		$ext = $ext[1];
		$new_name = str_replace(' ', '_', $_POST['fl_name_top_img_hd']).'.'.$ext;
		$cardUpd[$im_3_filename] = $new_name;

		if(!file_exists($file_path.$new_name)){
			rename($file_path.$old_top_fn, $file_path.$new_name);
			rename($file_path.'crop/466x363_'.$old_top_fn, $file_path.'crop/466x363_'.$new_name);
		}else{
			$data['status'] = "failed";
			$data['message'] = "Верхнее изображение нельзя переименовать по указанному значению";
			echo json_encode($data);
			exit();
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
	}elseif (strlen($_POST['fl_name_bot_img_hd']) > 0) {
		$ext = explode('.', $old_bot_fn);
		$ext = $ext[1];
		$new_name = str_replace(' ', '_', $_POST['fl_name_bot_img_hd']).'.'.$ext;
		$cardUpd[$im_4_filename] = $new_name;

		if(!file_exists($file_path.$new_name)){
			rename($file_path.$old_bot_fn, $file_path.$new_name);
			rename($file_path.'crop/466x363_'.$old_bot_fn, $file_path.'crop/466x363_'.$new_name);
		}else{
			$data['status'] = "failed";
			$data['message'] = "Нижнее изображение нельзя переименовать по указанному значению";
			echo json_encode($data);
			exit();
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
	}elseif (strlen($_POST['fl_name_modal_hd']) > 0) {
		$ext = explode('.', $old_bot_fn);
		$ext = $ext[1];
		$new_name = str_replace(' ', '_', $_POST['fl_name_modal_hd']).'.'.$ext;
		$cardUpd[$im_5_filename] = $new_name;

		if(!file_exists($file_path.$new_name)){
			rename($file_path.$old_modal_fn, $file_path.$new_name);
		}else{
			$data['status'] = "failed";
			$data['message'] = "Изображение модального окна нельзя переименовать по указанному значению";
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
				'resize_w'		=>466,
				'resize_h'		=>363,
				'resize_path_2'	=>"0",
				'resize_w_2'	=>0,
				'resize_h_2'	=>0
			  ));
		
		if($file_update)
		{
			$cardUpd[$im_1_filename] = $file_update;

			if (explode('.', $old_prev_fn)[0] != $_POST['fl_name_preview_hd']) {
				unlink($file_path.$old_prev_fn);
				unlink($file_path.'crop/466x363_'.$old_prev_fn);
			}
			
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

			if (explode('.', $old_ban_fn)[0] != $_POST['fl_name_banner_hd']) {
				unlink($file_path.$old_ban_fn);
				unlink($file_path.'crop/466x363_'.$old_ban_fn);
			}
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

			if (explode('.', $old_top_fn)[0] != $_POST['fl_name_top_img_hd']) {
				unlink($file_path.$old_top_fn);
				unlink($file_path.'crop/466x363_'.$old_top_fn);
			}
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

			if (explode('.', $old_bot_fn)[0] != $_POST['fl_name_bot_img_hd']) {
				unlink($file_path.$old_bot_fn);
				unlink($file_path.'crop/466x363_'.$old_bot_fn);
			}
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

			if (explode('.', $old_modal_fn)[0] != $_POST['fl_name_modal_hd']) {
				unlink($file_path.$old_modal_fn);
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

				'alt_banner'	=> $_POST['alt_banner'],
				'title_banner'	=> $_POST['title_banner'],

				'alt_top_img'	=> $_POST['alt_top_img'],
				'title_top_img'	=> $_POST['title_top_img'],

				'alt_bot_img'	=> $_POST['alt_bot_img'],
				'title_bot_img'	=> $_POST['title_bot_img'],

				'alt_modal'	=> $_POST['alt_modal'],
				'title_modal'	=> $_POST['title_modal'],

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
	