<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );		$data['headContent'] = $zh->getCardEditHeader($headParams);		// Start body content		$lang_fields = array(		'comment',		'author',		'signature'	);		$langs = $zh->getAvailableLangs();	$lpx_name = strtoupper($lpx ? $lpx."_" : DEF_LANG);		$cardItem = $zh->getHomeServicesItem($item_id, $lpx, $lang_fields);	$rootPath = ROOT_PATH;		$cardTmp = array(					 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ), // multilanguage important field					 					 'Название '.$lpx_name		=>	array( 'type'=>'input', 	'field'=>'author', 		'params'=>array( 'size'=>100, 'hold'=>'' ) ),					 					 'clear-0'				=>	array( 'type'=>'clear' ),					 					 'Подпись '.$lpx_name	=>	array( 'type'=>'hidden', 	'field'=>'signature', 	'params'=>array( 'size'=>100, 'hold'=>'' ) ),					 					 'clear-1'				=>	array( 'type'=>'clear' ),					 					 'Текст '.$lpx_name		=>	array( 'type'=>'redactor', 		'field'=>'comment', 		'params'=>array( 'size'=>100, 'hold'=>'' ) ),					 					 //'Image icon'			=>	array( 'type'=>'input', 	'field'=>'image', 		'params'=>array( 'size'=>50, 'hold'=>'fa fa-shield' ) ),					 					 'clear-2'				=>	array( 'type'=>'clear' ),					 																							 					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),					 					 'Порядковый номер'		=>	array( 'type'=>'number', 	'field'=>'order_id' ),					 'Изображения' => ['type'=>'header'],					 'Фото'		=>	array( 'type'=>'image_mono', 'field'=>'image', 		'params'=>array( 'path'=>RSF."/split/files/content/", 'appTable'=>$pageTable, 'id'=>1 ) ),					 					 'Имя изображения'	=>	array( 'type'=>'hidden',	'field'=>'curr_image', 	'params'=>array( 'field'=>"filename1" ) ),					 					 					 					 );	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editHomeServicesItem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );		$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);		// Join content		$data['bodyContent'] .= "		<div class='ipad-20' id='order_conteinter'>			<h3 class='new-line'>Форма редактирования Home Service Item #$item_id</h3>";		$data['bodyContent'] .= $cardEditFormStr;					$data['bodyContent'] .=	"		</div>	";?>