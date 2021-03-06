<?php 
	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	$cardItem = $zh->getRacksItem($item_id);
	$rootPath = ROOT_PATH;
	$cardTmp = array(
					 'ID'						=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),
					 'Name'					=>	array( 'type'=>'text', 		'field'=>'name',	 		'params'=>array() ),
					 'Alias'					=>	array( 'type'=>'text', 		'field'=>'alias', 			'params'=>array() ),
					 'Rows total quantity'					=>	array( 'type'=>'text', 		'field'=>'rows_limit', 			'params'=>array() ),
					 'Rows current quantity'					=>	array( 'type'=>'text', 		'field'=>'rows_count', 			'params'=>array() ),
					 'Warehouse'					=>	array( 'type'=>'text', 		'field'=>'warehouse_name', 			'params'=>array() ),
					 'Description'					=>	array( 'type'=>'text', 		'field'=>'description', 			'params'=>array() ),					 
					 'Position'			=>	array( 'type'=>'text', 		'field'=>'pos',		 		'params'=>array() ),
					 'Publish'				=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Yes', '1'=>'No') ) ),
					 'Created'			=>	array( 'type'=>'date', 		'field'=>'created', 		'params'=>array() ),
					 'Modified'		=>	array( 'type'=>'date', 		'field'=>'modified', 		'params'=>array() )
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Rack #$item_id detailed view</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>