<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'art_land' );
	
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	
	// Start body content
	
	$available_languages = $zh->getAvailableLangs();
	$cardItem = $zh->getArticleItem($item_id);
	
	// Get positions List
	
	$sitePositions = $zh->getPositions();
	
	// Get formats List
	
	$menuFormats = $zh->getMenuFormats();
	
	// Get Menu Categories
	
	$catsList = $zh->getCatsList();

	// Get Galleries List
	
	$galleriesList = $zh->getGalleriesList();

	$rootPath = ROOT_PATH;
	
	$cardTmp = array(


					'Категория материалов'	=>	array( 'type'=>'select', 	'field'=>'cat_id', 		'params'=>array( 'list'=>$catsList, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['cat_id'], 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'No select', 'id'=>0 ) 
																														 ) ),
					'clear-1'				=>	array( 'type'=>'clear' ),

					'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
						 
					//'Позиция'				=>	array( 'type'=>'input', 	'field'=>'order_id', 			'params'=>array( 'size'=>25, 'hold'=>'Позиция' ) ),

					'clear-3'				=>	array( 'type'=>'clear' ),

					'Название'				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>50, 'hold'=>'Название', 'onchange'=>"change_alias();" ) ),

					'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Алиас' ) ),

					'clear-4'				=>	array( 'type'=>'clear' ),
						 
					'Превью'				=>	array( 'type'=>'area', 		'field'=>'preview', 	'params'=>array( 'hold'=>'Краткое описание' ) ),

					'clear-5'				=>	array( 'type'=>'clear' ),

					'Содержание'			=>	array( 'type'=>'redactor', 		'field'=>'content', 	'params'=>array(  ) )
					 
					 );

					
					$second_part = array(

						/*'clear-6'				=>	array( 'type'=>'clear' ),
						'Галерея'				=>	array( 'type'=>'select', 'field'=>'gallery_id', 
																 	'params'=>array( 'list'=>$galleriesList, 
																					 'fieldValue'=>'id', 
																					 'fieldTitle'=>'name', 
																					 'currValue'=>$cardItem['gallery_id'], 
																					 'onChange'=>"", 
																					 'first'=>array( 'name'=>'Без галлереи', 'id'=>0 
																					 ) 
																				 ) ),*/

						'clear-5'				=>	array( 'type'=>'clear' ),

						'Изображение (1140x475)' => array('type' =>  'header'),
						'Изображение материала'=>	array( 'type'=>'image_mono','field'=>'fl_name_preview', 		'params'=>array( 'path'=>RSF."/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),

						'Имя изображения'	=>	array( 'type'=>'input', 	'field'=>'fl_name_preview_hd', 			'params'=>array( 'size'=>25 ) ),
						'Alt'				=>	array( 'type'=>'input', 	'field'=>'alt_preview', 			'params'=>array( 'size'=>25 ) ),
						'Title'				=>	array( 'type'=>'input', 	'field'=>'title_preview', 			'params'=>array( 'size'=>25 ) ),

						'clear-7'				=>	array( 'type'=>'clear' ),

						'Мета-теги' => array('type' =>  'header'),
						'Meta title'			=>	array( 'type'=>'input', 		'field'=>'meta_title', 	'params'=>array( 'size'=>100 ) ),
						'Meta desc'			=>	array( 'type'=>'area', 		'field'=>'meta_desc', 	'params'=>array(  ) ),
						'Meta keys'			=>	array( 'type'=>'area', 		'field'=>'meta_keys', 	'params'=>array(  ) )

						// 'av_langs' 			=>	array( 'type'=>'post_array', 		'field'=>'av_langs', 	'params'=>array('arr_field' =>  json_encode($available_languages) ) )


					);


					$cardTmp = array_merge($cardTmp, $second_part);
		


	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createArticle", 'ajaxFolder'=>'create', 'appTable'=>$appTable, 'lang_fields'=>$lang_inputs);
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма создания материала</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>