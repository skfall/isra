<?php 
	// Start header content
	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getPropositionsItem($item_id, $lpx);
	
	$langs = $zh->getAvailableLangs();
	$lpx_name = ($lpx ? $lpx : 'HE');

	$rootPath = ROOT_PATH;
	
	$cardTmp = array(
					 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ),
					 
					 'Название '.$lpx_name			=>	array( 'type'=>'input', 	'field'=>'name', 		'params'=>array( 'size'=>50, 'hold'=>'Name', 'onchange'=>"" ) ),					 
					 
					 'clear-0'				=>	array( 'type'=>'clear' ),
					 
					 'Details '.$lpx_name				=>	array( 'type'=>'area', 	'field'=>'details', 	'params'=>array( 'size'=>100, 'hold'=>'Details' ) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),

					 'URL'					=>	array( 'type'=>'input', 	'field'=>'url', 		'params'=>array( 'size'=>50, 'hold'=>'Url ', 'onchange'=>"" ) ),	
					 
					 
					 'Изображение '.$lpx_name			=>	array( 'type'=>'header'),
					 
					 'Изображение'		=>	array( 'type'=>'image_mono', 'field'=>'image', 		'params'=>array( 'path'=>RSF."/split/files/content/", 'appTable'=>$pageTable, 'id'=>1 ) ),
			 
			 		 'Имя изображения'	=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"image" ) )
					 
					 
					 );
	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editProposition", 'ajaxFolder'=>'edit', 'appTable'=>$appTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs  );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования Proposition #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";
?>