<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getPageServicesItem($item_id);

	$rootPath = ROOT_PATH;
	
	$cardTmp = array(
					 'Title'				=>	array( 'type'=>'input', 	'field'=>'title', 		'params'=>array( 'size'=>100, 'hold'=>'Title' ) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 'Caption'				=>	array( 'type'=>'area', 		'field'=>'caption', 	'params'=>array( 'size'=>100, 'hold'=>'Caption' ) ),
					 
					 'Details'				=>	array( 'type'=>'redactor', 		'field'=>'details', 	'params'=>array( 'size'=>100, 'hold'=>'Details' ) ),
					 
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 																							 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Порядковый номер'		=>	array( 'type'=>'number', 	'field'=>'order_id' ),
					 
					 
					 'Изображение'			=>	array( 'type'=>'header'),
					 
					 'Изображение'		=>	array( 'type'=>'image_mono', 'field'=>'image', 		'params'=>array( 'path'=>RSF."/split/files/content/", 'appTable'=>$pageTable, 'id'=>1 ) ),
			 
			 		 'Имя изображения'	=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"image" ) ),					 
																														 
																														 
					  'META INFO'		=>	array( 'type'=>'header'),
			 
					 'Meta Title'		=>	array( 'type'=>'input', 	'field'=>'meta_title', 'params'=>array( 'size'=>100, 'hold'=>'Meta title' ) ),
					 
					 'Clear-3'			=>	array( 'type'=>'clear' ),
					 
					 'Meta Keys'		=>	array( 'type'=>'input', 	'field'=>'meta_keys', 'params'=>array( 'size'=>100, 'hold'=>'Meta Keywords' ) ),
					 
					 'Clear-4'			=>	array( 'type'=>'clear' ),
					 
					 'Meta Description'	=>	array( 'type'=>'area', 		'field'=>'meta_desc', 'params'=>array( 'size'=>100, 'hold'=>'Meta Description' ) )
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createPageServicesItem", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма создания Page Services Item</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>