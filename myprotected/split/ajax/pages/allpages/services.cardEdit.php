<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$lang_fields = array(
		'title',
		'caption',
		'details',
		's1_title',
		's1_details'
	);
	
	$cardItem = $zh->getPageServicesItem($item_id, $lpx, $lang_fields);
	
	$tables 		= $zh->getAllTables();
	$parallaxes 	= $zh->getAllParallaxes();
	$galleries 		= $zh->getAllGalleries();

	$rootPath = ROOT_PATH;
	
	$langs = $zh->getAvailableLangs();
	$lpx_name = strtoupper($lpx ? $lpx."_" : DEF_LANG);
		
	$cardTmp = array(
					 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ), // multilanguage important field
					 
					 'Title '.$lpx_name				=>	array( 'type'=>'input', 	'field'=>'title', 		'params'=>array( 'size'=>100, 'hold'=>'Title' ) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 'Caption '.$lpx_name				=>	array( 'type'=>'area', 		'field'=>'caption', 	'params'=>array( 'size'=>100, 'hold'=>'Caption' ) ),
					 
					 'clear-11'				=>	array( 'type'=>'clear' ),					 
					 
					 'Details '.$lpx_name				=>	array( 'type'=>'redactor', 		'field'=>'details', 	'params'=>array( 'size'=>100, 'hold'=>'Details' ) ),
					 
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 																							 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Порядковый номер'		=>	array( 'type'=>'number', 	'field'=>'order_id' ),
					 
					 
					 'Изображение'			=>	array( 'type'=>'header'),
					 
					 'Изображение'		=>	array( 'type'=>'image_mono', 'field'=>'image', 		'params'=>array( 'path'=>RSF."/split/files/content/", 'appTable'=>$pageTable, 'id'=>1 ) ),
			 
			 		 'Имя изображения'	=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"image" ) ),
					 
					 'clear-3'				=>	array( 'type'=>'clear' ),
					 																							 
					 'ЧТО ВХОДИТ В НАШ БОКС'		=>	array( 'type'=>'block', 	'field'=>'box_contains', 			'params'=>array( 'reverse'=>true ) ),
					 																							 
					 'УПАКОВОЧНЫЕ МАТЕРИАЛЫ'		=>	array( 'type'=>'block', 	'field'=>'pack_list', 			'params'=>array( 'reverse'=>true ) ),
					 																							 
					 'ПОКАЗАТЬ КОНТАКТЫ'			=>	array( 'type'=>'block', 	'field'=>'contacts_view', 			'params'=>array( 'reverse'=>true ) ),
					 																							 
					 'ISRA GALLERY'					=>	array( 'type'=>'block', 	'field'=>'isra_gal', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'clear-4'					=>	array( 'type'=>'clear' ),
					 															
					 'Таблица'		=>	array( 'type'=>'select', 	'field'=>'table_id', 			'params'=>array( 'list'=>$tables,
					 																									 'first'=>array( 'name'=>'Не выбран', 'id'=>0 ), 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name',
																														 'currValue'=>$cardItem['table_id'], 
																														 'value'=>$cardItem['table_id']
																														 ) ),
					 																							 
					 															
					 'Parallax'		=>	array( 'type'=>'select', 	'field'=>'paral_id', 			'params'=>array( 'list'=>$parallaxes,
					 																									 'first'=>array( 'name'=>'Не выбран', 'id'=>0 ), 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name',
																														 'currValue'=>$cardItem['paral_id'], 
																														 'value'=>$cardItem['paral_id']
																														 ) ),
					 
					 
					 'ГАЛЕРЕЯ / ТЕКСТ'					=>	array( 'type'=>'header'),
					 																							 
					 'Публикация ГАЛЕРЕЯ / ТЕКСТ'		=>	array( 'type'=>'block', 	'field'=>'s1', 			'params'=>array( 'reverse'=>true ) ),
					 															
					 'Галерея_'		=>	array( 'type'=>'select', 	'field'=>'s1_gal_id', 			'params'=>array( 'list'=>$galleries,
					 																									 'first'=>array( 'name'=>'Не выбран', 'id'=>0 ), 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name',
																														 'currValue'=>$cardItem['s1_gal_id'], 
																														 'value'=>$cardItem['s1_gal_id']
																														 ) ),
					 																							 
					 															
					 'Parallax_'		=>	array( 'type'=>'select', 	'field'=>'s1_paral_id', 			'params'=>array( 'list'=>$parallaxes,
					 																									 'first'=>array( 'name'=>'Не выбран', 'id'=>0 ), 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name',
																														 'currValue'=>$cardItem['s1_paral_id'], 
																														 'value'=>$cardItem['s1_paral_id']
																														 ) ),
					 
					 'clear-5'					=>	array( 'type'=>'clear' ),
					 
					 'Title_ '.$lpx_name		=>	array( 'type'=>'input', 	'field'=>'s1_title', 		'params'=>array( 'size'=>100, 'hold'=>'Title' ) ),
					 
					 'clear-6'					=>	array( 'type'=>'clear' ),
					 
					 'Details_ '.$lpx_name		=>	array( 'type'=>'redactor', 		'field'=>'s1_details', 	'params'=>array( 'size'=>100, 'hold'=>'Details' ) ),
					 
					 
					 'ГАЛЕРЕЯ / ТАБЛИЦА'				=>	array( 'type'=>'header'),
					 																							 
					 'Публикация ГАЛЕРЕЯ / ТАБЛИЦА'	=>	array( 'type'=>'block', 	'field'=>'s2', 			'params'=>array( 'reverse'=>true ) ),
					 															
					 'Галерея__'		=>	array( 'type'=>'select', 	'field'=>'s2_gal_id', 			'params'=>array( 'list'=>$galleries,
					 																									 'first'=>array( 'name'=>'Не выбран', 'id'=>0 ), 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name',
																														 'currValue'=>$cardItem['s2_gal_id'], 
																														 'value'=>$cardItem['s2_gal_id']
																														 ) ),
					 															
					 'Таблица__'		=>	array( 'type'=>'select', 	'field'=>'s2_table_id', 			'params'=>array( 'list'=>$tables,
					 																									 'first'=>array( 'name'=>'Не выбран', 'id'=>0 ), 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name',
																														 'currValue'=>$cardItem['s2_table_id'], 
																														 'value'=>$cardItem['s2_table_id']
																														 ) ),
					 																							 
					 															
					 'Parallax__'		=>	array( 'type'=>'select', 	'field'=>'s2_paral_id', 			'params'=>array( 'list'=>$parallaxes,
					 																									 'first'=>array( 'name'=>'Не выбран', 'id'=>0 ), 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name',
																														 'currValue'=>$cardItem['s2_paral_id'], 
																														 'value'=>$cardItem['s2_paral_id']
																														 ) ),					 
																														 
																														 
					  'META INFO'		=>	array( 'type'=>'header'),
			 
					 'Meta Title'		=>	array( 'type'=>'input', 	'field'=>'meta_title', 'params'=>array( 'size'=>100, 'hold'=>'Meta title' ) ),
					 
					 'Clear-3'			=>	array( 'type'=>'clear' ),
					 
					 'Meta Keys'		=>	array( 'type'=>'input', 	'field'=>'meta_keys', 'params'=>array( 'size'=>100, 'hold'=>'Meta Keywords' ) ),
					 
					 'Clear-4'			=>	array( 'type'=>'clear' ),
					 
					 'Meta Description'	=>	array( 'type'=>'area', 		'field'=>'meta_desc', 'params'=>array( 'size'=>100, 'hold'=>'Meta Description' ) ),
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editPageServicesItem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования Page Services Item #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>