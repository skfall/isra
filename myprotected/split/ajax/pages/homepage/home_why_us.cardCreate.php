<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );		$data['headContent'] = $zh->getCardCreateHeader($headParams);		// Start body content		$cardItem = $zh->getHomeWhyUsItem($item_id);	$rootPath = ROOT_PATH;		$cardTmp = array(					 'Title'				=>	array( 'type'=>'input', 	'field'=>'title', 		'params'=>array( 'size'=>100, 'hold'=>'Title' ) ),					 					 //'Caption'				=>	array( 'type'=>'input', 	'field'=>'caption', 	'params'=>array( 'size'=>100, 'hold'=>'Caption' ) ),					 					 'Image icon'			=>	array( 'type'=>'input', 	'field'=>'image', 		'params'=>array( 'size'=>50, 'hold'=>'fa fa-shield' ) ),					 					 'clear-2'				=>	array( 'type'=>'clear' ),					 																							 					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),					 					 'Порядковый номер'		=>	array( 'type'=>'number', 	'field'=>'order_id' )					 					 					 );	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createHomeWhyUsItem", 'ajaxFolder'=>'create', 'appTable'=>$appTable );		$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);		// Join content		$data['bodyContent'] .= "		<div class='ipad-20' id='order_conteinter'>			<h3 class='new-line'>Форма создания Home Why Us Item</h3>";		$data['bodyContent'] .= $cardEditFormStr;					$data['bodyContent'] .=	"		</div>	";?>