<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );		$data['headContent'] = $zh->getCardViewHeader($headParams);		// Start body content		$cardItem = $zh->getAltUserInfo($item_id);	$rootPath = "../../../../..";		$cardTmp = array(					 'Имя'					=>	array( 'type'=>'text', 		'field'=>'name', 			'params'=>array() ),					 'Фамилия'				=>	array( 'type'=>'text', 		'field'=>'fname', 			'params'=>array() ),					 					 'Email'				=>	array( 'type'=>'text', 		'field'=>'login', 			'params'=>array() ),					 'Телефон'				=>	array( 'type'=>'text', 		'field'=>'phone', 			'params'=>array() ),					 'Второй Телефон'		=>	array( 'type'=>'text', 		'field'=>'second_phone', 			'params'=>array() ),					 'Переведен в пользователи'	=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Да', '1'=>'Нет') ) ),					 'COMMENT'				=>	array( 'type'=>'text', 		'field'=>'comment', 		'params'=>array() ),					 'Изображение'			=>	array( 'type'=>'image',		'field'=>'avatar',			'params'=>array( 'path'=>RSF.'/split/files/users/' ) ),					 'Документ'				=>	array( 'type'=>'doc',		'field'=>'data',			'params'=>array( 'path'=>RSF.'/split/files/users/' ) ),					 'Пол'					=>	array( 'type'=>'text', 		'field'=>'male', 			'params'=>array( 'replace'=>array('М'=>'Мужской', 'Ж'=>'Женский') ) ),					 //'Дочерние элементы'	=>	array( 'type'=>'arr_mult',	'field'=>'childs', 			'params'=>array( 'field'=>'name','link'=>array('parent'=>$parent,'alias'=>$alias,'id'=>$id,'item_id'=>1,'params'=>'{}') ) ),					 'Город'		=>	array( 'type'=>'text', 		'field'=>'delivery_address', 		'params'=>array( ) ),					 					 					 'ID'					=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),					 'Дата регистрации'		=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array( ) ),					 'Дата редактирования'	=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array( ) )					 // Pure-CSS-3D-Box.gif					 );	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );		$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);		// Join content		$data['bodyContent'] .= "		<div class='ipad-20' id='order_conteinter'>			<h3>Детальный просмотр карточки потенциального клиента</h3>";		$data['bodyContent'] .= $cardViewTableStr;					$data['bodyContent'] .=	"		</div>	";?>