<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams, $lpx);
	$pref = ($lpx ? $lpx.'_' : '');
	
	// Start body content
	
	$cardItem = $zh->getArticleItem($item_id, $lpx);

	$langs = $zh->getAvailableLangs();

	$rootPath = ROOT_PATH;
	
	$cardTmp = array(
					 'ID'					=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),
					 'Название '.$lpx		=>	array( 'type'=>'text', 		'field'=>$pref.'name', 			'params'=>array() ),					 
					 'Категория'				=>	array( 'type'=>'text', 		'field'=>'cat_name', 		'params'=>array() ),
					 'Алиас'				=>	array( 'type'=>'text', 		'field'=>'alias', 			'params'=>array() ),
					 'Публикация'			=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Да', '1'=>'Нет') ) ),

					 'Превью '.$lpx			=>	array( 'type'=>'text', 		'field'=>$pref.'preview', 		'params'=>array() ),
					 'Содержание '.$lpx		=>	array( 'type'=>'text', 		'field'=>$pref.'content', 		'params'=>array() ),

					 'Изображение'			=>	array( 'type'=>'image',		'field'=>'fl_name_preview',			'params'=>array( 'path'=>RSF.'/split/files/images/' ) ),
					 
					 'Дата создания'			=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array() ),
					 'Дата публикации'		=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array() ),
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Детальный просмотр материала #$item_id</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>