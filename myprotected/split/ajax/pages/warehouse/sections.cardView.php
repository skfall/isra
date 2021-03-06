<?php 


	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	$cardItem = $zh->getSectionsItem($item_id);
	$cardItem["fullname"] = $cardItem["rack_name"].$cardItem["row_name"].'-'.$cardItem["name"];
	$cardItem["fullrowname"] = $cardItem["rack_name"].$cardItem["row_name"];
	$rootPath = ROOT_PATH;
	$cardTmp = array(
					 'ID'						=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),
					 'Name'					=>	array( 'type'=>'text', 		'field'=>'name',	 		'params'=>array() ),
					 'Full name'					=>	array( 'type'=>'text', 		'field'=>'fullname',	 		'params'=>array() ),
					 'Shelves'					=>	array( 'type'=>'text', 		'field'=>'size_x',	 		'params'=>array() ),
					 
					 //'Alias'					=>	array( 'type'=>'text', 		'field'=>'alias', 			'params'=>array() ),
					 'Warehouse'					=>	array( 'type'=>'text', 		'field'=>'warehouse_name', 			'params'=>array() ),
					 'Rack'					=>	array( 'type'=>'text', 		'field'=>'rack_name', 			'params'=>array() ),
					 'Row'					=>	array( 'type'=>'text', 		'field'=>'fullrowname', 			'params'=>array() ),
					 'Description'					=>	array( 'type'=>'text', 		'field'=>'description', 			'params'=>array() ),					 
					 'Publish'				=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Yes', '1'=>'No') ) ),
					 'Created'			=>	array( 'type'=>'date', 		'field'=>'created', 		'params'=>array() ),
					 'Modified'		=>	array( 'type'=>'date', 		'field'=>'modified', 		'params'=>array() )
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Section ".$cardItem['fullname']." detailed view</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>