<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getArtCategoriesItem($item_id, $lpx);
	
	$langs = $zh->getAvailableLangs();
	$lpx_name = ($lpx ? $lpx : 'he');

	$rootPath = ROOT_PATH;
	
	$cardTmp = array(
					 
					 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ),
					 
					 'Название'				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>25, 'hold'=>'Name', 'onchange'=>"change_alias();" ) ),
					 
					 'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>25, 'hold'=>'Alias' ) ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Описание категории'	=>	array( 'type'=>'redactor', 		'field'=>'details', 		'params'=>array(  ) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),

					 'Мета-теги' => array('type' =>  'header'),
					 'Meta title '.strtoupper($lpx_name)		=>	array( 'type'=>'input', 	'field'=>'meta_title', 	'params'=>array( 'size'=>100 ) ),
					 'Meta desc '.strtoupper($lpx_name)			=>	array( 'type'=>'area', 		'field'=>'meta_desc', 	'params'=>array( 'size'=>100 ) ),
					 'Meta keys '.strtoupper($lpx_name)			=>	array( 'type'=>'area', 		'field'=>'meta_keys', 	'params'=>array( 'size'=>100 ) )
					 
					 /*'Изображения'			=>	array( 'type'=>'header'),
					 
					 'Изображение категории'=>	array( 'type'=>'image_mono','field'=>'filename', 		'params'=>array( 'path'=>RSF."/split/files/banners/", 'appTable'=>$appTable, 'id'=>$item_id ) ),
					 
					 'Имя изображения'		=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"filename" ) )*/
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editArtsCategory", 'ajaxFolder'=>'edit', 'appTable'=>$appTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования категории материалов #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>