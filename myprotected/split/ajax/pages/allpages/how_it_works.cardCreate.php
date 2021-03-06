<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getPageHowItWorksItem($item_id);

	$rootPath = ROOT_PATH;
	
	$cardTmp = array(
					 'Title'				=>	array( 'type'=>'input', 	'field'=>'title', 		'params'=>array( 'size'=>100, 'hold'=>'Title' ) ),
					 
					 'clear-0'				=>	array( 'type'=>'clear' ),
					 
					 'Details'				=>	array( 'type'=>'area', 		'field'=>'details', 	'params'=>array( 'size'=>100, 'hold'=>'Details' ) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 'Icon'					=>	array( 'type'=>'input', 	'field'=>'filename', 	'params'=>array( 'size'=>100, 'hold'=>'fa-smile' ) ),
					 
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 																							 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Порядковый номер'		=>	array( 'type'=>'number', 	'field'=>'order_id' ),
					 
					 /*
					 
					 'Файлы'			=>	array( 'type'=>'header'),

			 		 'Изображение'		=>	array( 'type'=>'image_mono', 'field'=>'image', 		'params'=>array( 'path'=>RSF."/split/files/content/", 'appTable'=>$pageTable, 'id'=>1 ) ),
			 
			 		 'Имя изображения'	=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"image" ) )
					 
					 */
					 
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createPageHowItWorksItem", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма создания Page How It Works Item</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>