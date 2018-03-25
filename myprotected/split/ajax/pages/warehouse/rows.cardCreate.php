<?php 
	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	$lpx_name = 'ru';
	$cardItem = $zh->getRowsItem($item_id);
	$warehouses = $zh->getWarehousesList();
	$first_wh = array();
	if ($warehouses) {
		$first_wh = $warehouses[0];
	}
	$racks = $zh->getRacksList($first_wh['id']);

	$rootPath = ROOT_PATH;
	$cardTmp = array(
		//'onchange' => 'change_alias();'
					 'Name'				=>	array( 'type'=>'input', 'field'=>'name', 'params'=>array( 'size'=>40, 'hold'=>'Name',  ) ),
					 //'Alias'				=>	array( 'type'=>'input', 'field'=>'alias', 'params'=>array( 'size'=>40, 'hold'=>'Alias' ) ),
					 'clear-0'				=>	array( 'type'=>'clear' ),
					 'Warehouse'	=>	array( 'type'=>'select', 	'field'=>'warehouse_id', 		'params'=>array( 'list'=>$warehouses, 
						 'fieldValue'=>'id', 
						 'fieldTitle'=>'name', 
						 'currValue'=>$cardItem['warehouse_id'], 
						 'onChange'=>"warehouse.loadRacksByWh(this.value)"
						 ) ),
					 'Rack'	=>	array( 'type'=>'select', 	'field'=>'rack_id', 		'params'=>array( 'list'=>$racks, 
						 'fieldValue'=>'id', 
						 'fieldTitle'=>'name', 
						 'currValue'=>$cardItem['rack_id'], 
						 'onChange'=>""
						 ) ),
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 'Publish'			=>	array( 'type'=>'block', 'field'=>'block', 'params'=>array( 'reverse'=>true )),
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 'Description'				=>	array( 'type'=>'area', 'field'=>'description', 'params'=>array( 'size'=>100, 'hold'=>'Description' ) ),					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createRow", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Rows create form</h3>";
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>