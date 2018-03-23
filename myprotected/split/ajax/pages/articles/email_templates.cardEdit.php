<?php
// Start header content

$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable);

$data['headContent'] = $zh->getCardEditHeader($headParams);

// Start body content

$cardItem = $zh->getTemplateInfo($item_id, $lpx);
$langs = $zh->getAvailableLangs();
$lpx_name = ($lpx ? $lpx : 'he');

$rootPath = "../../../../..";

$cardTmp = array(
    'LPX'      =>  array( 'type'=>'hidden',    'field'=>'lpx', 'value'=>$lpx ),
    
    'Название'                  =>  array( 'type'=>'hidden',        'field'=>'name' ),
    'Название шаблона'		    =>	array( 'type'=>'input', 		'field'=>'name', 		'params'=>array( 'size'=>50, 'disabled'=>true) ),
    'clear-1'				    =>	array( 'type'=>'clear' ),
    'Заголовок сообщения '.strtoupper($lpx_name)		=>	array( 'type'=>'input', 		'field'=>'subject', 	'params'=>array( 'size'=>100) ),
    'clear-2'				    =>	array( 'type'=>'clear' ),
    'Текст сообщения '.strtoupper($lpx_name)			=>	array( 'type'=>'redactor', 		'field'=>'body',        'params'=>array( 'size'=>50) ),
    'clear-3'				    =>	array( 'type'=>'clear' ),
    'Email рассылки'		    =>	array( 'type'=>'input', 		'field'=>'email_from', 	'params'=>array( 'size'=>50)),
);

$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editETemplate", 'ajaxFolder'=>'edit', 'appTable'=>$appTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs );

$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);

// Join content

$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования Шаблона писем #$item_id</h3>";

$data['bodyContent'] .= $cardEditFormStr;

$data['bodyContent'] .=	"
		</div>
	";

?>