<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );		$data['headContent'] = $zh->getCardViewHeader($headParams);		// Start body content		$lang_fields = array(		'comment',		'author',		'signature'	);		$langs = $zh->getAvailableLangs();	$lpx_name = strtoupper($lpx ? $lpx."_" : DEF_LANG);		$cardItem = $zh->getHomeServicesItem($item_id, $lpx, $lang_fields);	$rootPath = ROOT_PATH;		$cardTmp = array(					 // 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ), // multilanguage important field					 					 'ID'						=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),					 'Текст '.$lpx_name			=>	array( 'type'=>'text', 		'field'=>'comment', 		'params'=>array() ),					 'Название '.$lpx_name			=>	array( 'type'=>'text', 		'field'=>'author', 			'params'=>array() ),					 // 'Подпись '.$lpx_name		=>	array( 'type'=>'text', 		'field'=>'signature', 		'params'=>array() ),					 'Image'					=>	array( 'type'=>'text', 		'field'=>'image', 			'params'=>array() ),					 'Порядковый номер'			=>	array( 'type'=>'text', 		'field'=>'order_id', 		'params'=>array() ),					 'Публикация'				=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Да', '1'=>'Нет') ) ),					 'Дата создания'			=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array() ),					 'Дата редактирования'		=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array() )					 );	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );		$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);		// Join content		$data['bodyContent'] .= "		<div class='ipad-20' id='order_conteinter'>			<h3>Детальный просмотр Home Review #$item_id</h3>";		$data['bodyContent'] .= $cardViewTableStr;					$data['bodyContent'] .=	"		</div>	";?>