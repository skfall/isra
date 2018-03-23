<?php 
	// Start header content
	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'menuEditHeader' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getMenuItem($item_id, $lpx);
	
	// Get formats List
	
	$parents = $zh->getMenuParents($item_id);
	$langs = $zh->getAvailableLangs();
	$lpx_name = ($lpx ? $lpx : 'he');
	
	$rootPath = ROOT_PATH;
	
	$cardTmp = array(
					 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ),
					 'Название '.strtoupper($lpx_name)	=>	array( 'type'=>'input', 	'field'=>'name', 	'params'=>array( 'size'=>50, 'hold'=>'Название '.$lpx_name) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 // 'Алиас (URL)'			=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Alias' ) ),
					 
					
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 
					 'Вложенность'			=>	array( 'type'=>'select', 	'field'=>'parent_id', 			'params'=>array( 'list'=>$parents,
					 																									'first'=>array( 'name'=>'Не выбран', 'id'=>0 ), 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name'
																														 
																														 ) ),
					 
					 'clear-3'				=>	array( 'type'=>'clear' ),
					 
					 
					 'Позиция'				=>	array( 'type'=>'number', 	'field'=>'order_id', 		'params'=>array( 'size'=>25, 'hold'=>'Позиция' ) ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'clear-4'				=>	array( 'type'=>'clear' ),
					 
					 'Отображать в шапке?'	=>	array( 'type'=>'block', 	'field'=>'is_top', 			'params'=>array( 'reverse'=>false ) ),
					 
					 'Отображать в футере?'	=>	array( 'type'=>'block', 	'field'=>'is_bottom', 		'params'=>array( 'reverse'=>false ) )
					 
					 );
	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editMenuItem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования пункта меню #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";
?>