<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );		$data['headContent'] = $zh->getCardCreateHeader($headParams);	$available_languages = $zh->getAvailableLangs();		// Start body content		$cardItem = $zh->getPromoItem($item_id);	$rootPath = ROOT_PATH;		$cardTmp = array(					 'CODE'				=>	array( 'type'=>'input', 		'field'=>'code', 		'params'=>array( 'size'=>50, 'hold'=>'Code' ) ),						 					 'DISCOUNT'			=>	array( 'type'=>'input', 		'field'=>'value', 		'params'=>array( 'size'=>50, 'hold'=>'Discount Sheckels' ) ),						 					 'Clear-1'			=> 	array('type'=>'clear'),					 					 'REUSABLE'			=>	array( 'type'=>'block', 		'field'=>'reusable', 		'params'=>array( 'reverse'=>false ) ),						 					 'USER FOR (ID'		=>	array( 'type'=>'number', 		'field'=>'user_for', 		'params'=>array( 'size'=>25, 'hold'=>'0/USER ID' ) ),					 					 'DATE EXPIRES'		=>	array( 'type'=>'date', 		'field'=>'expires', 		'params'=>array( 'size'=>50 ) ),						 					 );	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createDiscount", 'ajaxFolder'=>'create', 'appTable'=>$appTable );		$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);		// Join content		$data['bodyContent'] .= "		<div class='ipad-20' id='order_conteinter'>			<h3 class='new-line'>Форма создания NEW PROMO CODE</h3>";		$data['bodyContent'] .= $cardEditFormStr;					$data['bodyContent'] .=	"		</div>	";?>