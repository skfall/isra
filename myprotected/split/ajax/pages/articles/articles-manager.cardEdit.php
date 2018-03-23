<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable ,'type'=>'art_land' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getArticleItem($item_id, $lpx);
	
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
	
	$langs = $zh->getAvailableLangs();
	$lpx_name = ($lpx ? $lpx : 'he');

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
				 
					'Дата публикации'		=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array(  ) ),				
					
					'clear-1'				=>	array( 'type'=>'clear' ),

					'Название '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>50, 'hold'=>'Название '.$lpx_name, 'onchange'=>"change_alias();" ) )

					 );

					if ($lpx_name != 'en') {
						$alias_array = array(
							'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Алиас') ),
						);
					}else{
						$alias_array = array(
							'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Алиас') ),
						);
					}
					$cardTmp = array_merge($cardTmp, $alias_array);
					 
					$sec_part = array(
					  'clear-0'				=>	array( 'type'=>'clear' ),
					 
					 'Превью '.strtoupper($lpx_name)			=>	array( 'type'=>'area', 		'field'=>'preview', 	'params'=>array( 'hold'=>'Краткое описание' ) ),
					 
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 
					 'Содержание '.strtoupper($lpx_name)		=>	array( 'type'=>'redactor', 	'field'=>'content', 	'params'=>array(  ) ),


					 'clear-33532'				=>	array( 'type'=>'clear' ),
						 
					 /*'Галерея'				=>	array( 'type'=>'select', 'field'=>'gallery_id', 
														'params'=>array( 'list'=>$galleriesList, 
																		 'fieldValue'=>'id', 
																		 'fieldTitle'=>'name', 
																		 'currValue'=>$cardItem['gallery_id'], 
																		 'onChange'=>"", 
																		 'first'=>array( 'name'=>'Без галлереи', 'id'=>0 
																		 ) 
																	 ) ),*/


					'Изображение' => array('type' =>  'header'),
					'Изображение материала (1140x475)'=>	array( 'type'=>'image_mono','field'=>'fl_name_preview', 		'params'=>array( 'path'=>RSF."/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),


					'Текущее имя изображения'	=>	array( 'type'=>'input', 	'field'=>'fl_name_preview', 			'params'=>array( 'size'=>25, 'disabled' => true ) ),
					'Новое имя изображения (без расширения)'	=>	array( 'type'=>'input', 	'field'=>'fl_name_preview_hd', 			'params'=>array( 'size'=>25 ) ),
					'clear-23123'				=>	array( 'type'=>'clear' ),
					'Alt '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'alt_preview', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->alt_preview ) ),
					'Title '.strtoupper($lpx_name)				=>	array( 'type'=>'input', 	'field'=>'title_preview', 			'params'=>array( 'size'=>25, 'value'=>$imageAlts->title_preview ) ),
					 
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