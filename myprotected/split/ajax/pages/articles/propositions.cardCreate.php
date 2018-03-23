<?php 
	// Start header content
	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'gall_h' );
	
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getPropositionsItem($item_id);
	
	// Get positions List
	
	$sitePositions = $zh->getPositions();
	
	// Get categories List
	
	$catsList = $zh->getCatsList();
	$rootPath = ROOT_PATH;
	
	$cardTmp = array(
					 'Название'			=>	array( 'type'=>'input', 	'field'=>'name', 		'params'=>array( 'size'=>50, 'hold'=>'Name', 'onchange'=>"" ) ),					 
					 
					 'clear-0'				=>	array( 'type'=>'clear' ),
					 
					 'Details'				=>	array( 'type'=>'area', 	'field'=>'details', 	'params'=>array( 'size'=>100, 'hold'=>'Details' ) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),

					 'URL'					=>	array( 'type'=>'input', 	'field'=>'url', 		'params'=>array( 'size'=>50, 'hold'=>'Url ', 'onchange'=>"" ) ),	
					 
					 
					 'Изображение'			=>	array( 'type'=>'header'),
					 
					 'Изображение'		=>	array( 'type'=>'image_mono', 'field'=>'image', 		'params'=>array( 'path'=>RSF."/split/files/content/", 'appTable'=>$pageTable, 'id'=>1 ) ),
			 
			 		 'Имя изображения'	=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"image" ) )
					 
					 );
	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createProposition", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма создания Proposition</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";
?>