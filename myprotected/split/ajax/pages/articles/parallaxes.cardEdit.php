<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'gall_h' );		$data['headContent'] = $zh->getCardEditHeader($headParams);		// Start body content		$cardItem = $zh->getParallaxesItem($item_id);		$rootPath = ROOT_PATH;		$cardTmp = array(					 'Название'			=>	array( 'type'=>'input', 	'field'=>'name', 		'params'=>array( 'size'=>50, 'hold'=>'Name', 'onchange'=>"" ) ),					 					 					 'clear-0'				=>	array( 'type'=>'clear' ),					 					 'Caption'				=>	array( 'type'=>'area', 	'field'=>'caption', 	'params'=>array( 'size'=>100, 'hold'=>'Caption' ) ),					 					 'clear-1'				=>	array( 'type'=>'clear' ),					 					 'Button name'			=>	array( 'type'=>'input', 	'field'=>'button_name', 	'params'=>array( 'size'=>100, 'hold'=>'Button name' ) ),					 					 'clear-2'				=>	array( 'type'=>'clear' ),					 					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),					 					 					 'Изображение'			=>	array( 'type'=>'header'),					 					 'Изображение'		=>	array( 'type'=>'image_mono', 'field'=>'image', 		'params'=>array( 'path'=>RSF."/split/files/content/", 'appTable'=>$pageTable, 'id'=>1 ) ),			 			 		 'Имя изображения'	=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"image" ) )					 					 					 );	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editParallax", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );		$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);		// Join content		$data['bodyContent'] .= "		<div class='ipad-20' id='order_conteinter'>			<h3 class='new-line'>Форма редактирования Parallax #$item_id</h3>";		$data['bodyContent'] .= $cardEditFormStr;					$data['bodyContent'] .=	"		</div>	";?>