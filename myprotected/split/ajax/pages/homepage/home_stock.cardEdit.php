<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );		$data['headContent'] = $zh->getCardEditHeader($headParams);		// Start body content		$lang_fields = array(		'title',		'caption'	);		$langs = $zh->getAvailableLangs();	$lpx_name = strtoupper($lpx ? $lpx."_" : DEF_LANG);		$cardItem = $zh->getStockItem($item_id, $lpx, $lang_fields);	$rootPath = ROOT_PATH;		$cardTmp = array(					 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ), // multilanguage important field					 					 'Title '.$lpx_name		=>	array( 'type'=>'input', 	'field'=>'title', 		'params'=>array( 'size'=>100, 'hold'=>'Title' ) ),					 					 'Caption '.$lpx_name	=>	array( 'type'=>'input', 	'field'=>'caption', 	'params'=>array( 'size'=>100, 'hold'=>'Caption' ) ),					 					 'Image icon'			=>	array( 'type'=>'input', 	'field'=>'image', 		'params'=>array( 'size'=>50, 'hold'=>'fa fa-shield' ) ),					 					 'clear-2'				=>	array( 'type'=>'clear' ),					 																							 					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),					 					 'Порядковый номер'		=>	array( 'type'=>'number', 	'field'=>'order_id' )					 					 					 );	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editStockItem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );		$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);		// Join content		$data['bodyContent'] .= "		<div class='ipad-20' id='order_conteinter'>			<h3 class='new-line'>Форма редактирования Stick Item #$item_id</h3>";		$data['bodyContent'] .= $cardEditFormStr;					$data['bodyContent'] .=	"		</div>	";?>