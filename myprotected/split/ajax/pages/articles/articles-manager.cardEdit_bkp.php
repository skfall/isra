<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable ,'type'=>'art_land' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getArticleItem($item_id, $lpx);

	$langs = $zh->getAvailableLangs();
	$lpx_name = ($lpx ? $lpx : 'en');
	
	// Get positions List

	$imageAlts = $zh->getImageAlts($item_id, $lpx);

	$imageAlts = json_decode($imageAlts[0]['data']);

	
	$sitePositions = $zh->getPositions();
	
	// Get formats List
	
	$menuFormats = $zh->getMenuFormats();
	
	// Get Menu Categories
	
	$catsList = $zh->getCatsList();

	// Get Galleries List
	
	$galleriesList = $zh->getGalleriesList();

	$rootPath = ROOT_PATH;


	
	$cardTmp = array(
					 
					'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ),



					 'Категория материалов'	=>	array( 'type'=>'select', 	'field'=>'cat_id', 		'params'=>array( 'list'=>$catsList, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['cat_id'], 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'No select', 'id'=>0 ) 
																														 ) ),



					 
					 'clear-123'				=>	array( 'type'=>'clear' ),





					 	'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
						 
						 'Позиция'				=>	array( 'type'=>'input', 	'field'=>'order_id', 			'params'=>array( 'size'=>25, 'hold'=>'Позиция' ) ),
						 
						  'В новом окне?'		=>	array( 'type'=>'block', 	'field'=>'target', 			'params'=>array( 'reverse'=>false ) ),

						   'clear-11111112'				=>	array( 'type'=>'clear' ),
						  'Разместить в категорию "Популярные"?'		=>	array( 'type'=>'block', 	'field'=>'popular', 			'params'=>array( 'reverse'=>false ) ),
						'clear-31a1'				=>	array( 'type'=>'clear' ),

						'Ссылка на "Google Play"?'					=>	array( 'type'=>'input', 	'field'=>'google_play', 			'params'=>array(  ) ),
						'Ссылка на "App Store"?'					=>	array( 'type'=>'input', 	'field'=>'app_store', 			'params'=>array(  ) ),
						'Ссылка на "PC"?'		=>	array( 'type'=>'input', 	'field'=>'pc', 			'params'=>array(  ) ),
						'Ссылка на "Macintosh"?'		=>	array( 'type'=>'input', 	'field'=>'mac', 			'params'=>array(  ) ),

						  'clear-1'				=>	array( 'type'=>'clear' ),

					 	'Название '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>50, 'hold'=>'Название '.$lpx_name, 'onchange'=>"change_alias();" ) )


					 	);

						if ($lpx_name != 'en') {
							$alias_array = array(
								'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Алиас', 'readonly' => true ) ),
							);
						}else{
							$alias_array = array(
								'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Алиас') ),
							);
						}
						$cardTmp = array_merge($cardTmp, $alias_array);
						 
						$sec_part = array(
						  'clear-0'				=>	array( 'type'=>'clear' ),
						 
						 
						 /*'Видеоматериал?'		=>	array( 'type'=>'block', 	'field'=>'is_video', 		'params'=>array( 'reverse'=>false ) ),*/
						 
						 'clear-2'				=>	array( 'type'=>'clear' ),
						 
						 'Содержание '.strtoupper($lpx_name)			=>	array( 'type'=>'redactor', 		'field'=>'content', 	'params'=>array(  ) ),


						 'clear-33532'				=>	array( 'type'=>'clear' ),


							 
							 'Галерея'				=>	array( 'type'=>'select', 'field'=>'gallery_id', 
															 	'params'=>array( 'list'=>$galleriesList, 
																				 'fieldValue'=>'id', 
																				 'fieldTitle'=>'name', 
																				 'currValue'=>$cardItem['gallery_id'], 
																				 'onChange'=>"", 
																				 'first'=>array( 'name'=>'Без галлереи', 'id'=>0 
																				 ) 
																			 ) ),

							 'Горизонтальная галерея?'		=>	array( 'type'=>'block', 	'field'=>'gal_orient', 			'params'=>array( 'reverse'=>false ) ),


						'Превью' => array('type' =>  'header'),
						'Изображение материала'=>	array( 'type'=>'image_mono','field'=>'fl_name_preview', 		'params'=>array( 'path'=>RSF."/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),


						'Текущее имя изображения'	=>	array( 'type'=>'input', 	'field'=>'fl_name_preview', 			'params'=>array( 'size'=>25, 'disabled' => true ) ),
						'Новое имя изображения (без расширения)'	=>	array( 'type'=>'input', 	'field'=>'fl_name_preview_hd', 			'params'=>array( 'size'=>25 ) ),
						'clear-23123'				=>	array( 'type'=>'clear' ),
						'Alt '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'alt_preview', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->alt_preview ) ),
						'Title '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'title_preview', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->title_preview ) ),

						

						'Баннер' => array('type' =>  'header'),
						'Изображение материала &nbsp;'=>	array( 'type'=>'image_mono','field'=>'fl_name_banner', 		'params'=>array( 'path'=>RSF."/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),

						'Текущее имя изображения &nbsp;'	=>	array( 'type'=>'input', 	'field'=>'fl_name_banner', 			'params'=>array( 'size'=>25, 'disabled' => true ) ),
						'Новое имя изображения (без расширения)&nbsp;'	=>	array( 'type'=>'input', 	'field'=>'fl_name_banner_hd', 			'params'=>array( 'size'=>25 ) ),
						'clear-434342'				=>	array( 'type'=>'clear' ),
						'Alt &nbsp; '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'alt_banner', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->alt_banner ) ),
						'Title &nbsp; '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'title_banner', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->title_banner ) ),



						'Верхнее изображение' => array('type' =>  'header'),
						'Изображение материала &nbsp;&nbsp;'=>	array( 'type'=>'image_mono','field'=>'fl_name_top_img', 		'params'=>array( 'path'=>RSF."/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),

						'Текущее имя изображения &nbsp;&nbsp;'	=>	array( 'type'=>'input', 	'field'=>'fl_name_top_img', 			'params'=>array( 'size'=>25,'disabled' => true ) ),
						'Новое имя изображения (без расширения)&nbsp;&nbsp;'	=>	array( 'type'=>'input', 	'field'=>'fl_name_top_img_hd', 			'params'=>array( 'size'=>25 ) ),
						'clear-26565'				=>	array( 'type'=>'clear' ),
						'Alt &nbsp; &nbsp; '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'alt_top_img', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->alt_top_img ) ),
						'Title &nbsp;&nbsp; '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'title_top_img', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->title_top_img ) ),


						'Нижнее изображение' => array('type' =>  'header'),
						'Изображение материала &nbsp;&nbsp;&nbsp;'=>	array( 'type'=>'image_mono','field'=>'fl_name_bot_img', 		'params'=>array( 'path'=>RSF."/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),

						'Текущее имя изображения &nbsp;&nbsp;&nbsp;'	=>	array( 'type'=>'input', 	'field'=>'fl_name_bot_img', 			'params'=>array( 'size'=>25, 'disabled' => true ) ),
						'Новое имя изображения (без расширения)&nbsp;&nbsp;&nbsp;'	=>	array( 'type'=>'input', 	'field'=>'fl_name_bot_img_hd', 			'params'=>array( 'size'=>25 ) ),
						'clear-13452'				=>	array( 'type'=>'clear' ),
						'Alt &nbsp;&nbsp;&nbsp; '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'alt_bot_img', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->alt_bot_img ) ),
						'Title &nbsp;&nbsp;&nbsp; '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'title_bot_img', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->title_bot_img ) ),


						'Изображение модального окна' => array('type' =>  'header'),
						'Изображение материала &nbsp;&nbsp;&nbsp;&nbsp;'=>	array( 'type'=>'image_mono','field'=>'fl_name_modal', 		'params'=>array( 'path'=>RSF."/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),

						'Текущее имя изображения &nbsp;&nbsp;&nbsp;&nbsp;'	=>	array( 'type'=>'input', 	'field'=>'fl_name_modal', 			'params'=>array( 'size'=>25, 'disabled' => true ) ),
						'Новое имя изображения (без расширения)&nbsp;&nbsp;&nbsp;&nbsp;'	=>	array( 'type'=>'input', 	'field'=>'fl_name_modal_hd', 			'params'=>array( 'size'=>25 ) ),
						'clear-1345d2'				=>	array( 'type'=>'clear' ),

						'Alt &nbsp;&nbsp;&nbsp;&nbsp; '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'alt_modal', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->alt_modal ) ),
						'Title &nbsp;&nbsp;&nbsp;&nbsp; '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'title_modal', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->title_modal ) ),



							 
						'clear-3332'				=>	array( 'type'=>'clear' ),



						 	
							 
							 



						 
						 'clear-11233263'				=>	array( 'type'=>'clear' ),

						 'Мета-теги' => array('type' =>  'header'),
						 'Meta title '.strtoupper($lpx_name)			=>	array( 'type'=>'input', 		'field'=>'meta_title', 	'params'=>array( 'size'=>100, 'value' =>$imageAlts->meta_title ) ),
						 'Meta desc '.strtoupper($lpx_name)			=>	array( 'type'=>'area', 		'field'=>'meta_desc', 	'params'=>array( 'value' =>$imageAlts->meta_desc ) ),
						 'Meta keys '.strtoupper($lpx_name)			=>	array( 'type'=>'area', 		'field'=>'meta_keys', 	'params'=>array( 'value' =>$imageAlts->meta_keys ) )
						 
					 );

					$cardTmp = array_merge($cardTmp, $sec_part);


	
	

	
	

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editArticleItem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs  );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования материала #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>