<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );		$data['headContent'] = $zh->getCardViewHeader($headParams);		// Start body content		$lang_fields = array(		'title',		'details'	);		$cardItem = $zh->getPageHowItWorksItem($item_id, $lpx, $lang_fields);	$rootPath = ROOT_PATH;		$langs = $zh->getAvailableLangs();	$lpx_name = strtoupper($lpx ? $lpx."_" : DEF_LANG);		$cardTmp = array(					 'ID'						=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),					 'Title '.$lpx_name			=>	array( 'type'=>'text', 		'field'=>'title', 			'params'=>array() ),					 'Details '.$lpx_name		=>	array( 'type'=>'text', 		'field'=>'details', 		'params'=>array() ),					 'Icon'						=>	array( 'type'=>'text', 		'field'=>'filename', 		'params'=>array() ),					 'Порядковый номер'			=>	array( 'type'=>'text', 		'field'=>'order_id', 		'params'=>array() ),					 'Публикация'				=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Да', '1'=>'Нет') ) ),					 'Дата создания'			=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array() ),					 'Дата редактирования'		=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array() )					 );	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );		$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);		// Join content		$data['bodyContent'] .= "		<div class='ipad-20' id='order_conteinter'>			<h3>Детальный просмотр Page How It Works Item #$item_id</h3>";		$data['bodyContent'] .= $cardViewTableStr;					$data['bodyContent'] .=	"		</div>	";?>