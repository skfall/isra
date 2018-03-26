<?php 
	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	$lpx_name = 'ru';
	$cardItem = $zh->getCellsItem($item_id);
	$warehouses = $zh->getWarehousesList();
	$first_wh = array();
	if ($warehouses) {
		$first_wh = $warehouses[0];
	}
	$racks = $zh->getRacksList($first_wh['id']);
	$first_rack= array();
	if ($racks) {
		$first_rack = $racks[0];
	}
	$rows = $zh->getRowsList($first_rack['id']);
	$first_row = array();
	if ($rows) {
		$first_row = $rows[0];
	}

	$sections = $zh->getSectionsList($first_row['id']);

	if ($rows) {
		foreach ($rows as $k => &$r) {
			$available_shelves = $zh->getAvailableShelvesForRow($r["size_x"], $r["id"]);
			$r["fs_name"] = $r["rack_name"].$r["name"]." (available shelves: ".$available_shelves.")";
		}
	}

	if ($sections) {
		foreach ($sections as $k => &$s) {
			$s["section_name"] = $s["rack_name"].$s['row_name'].'-'.$s["name"];
		}
	}

	$cell_types = array(
	 	array('id' => 1, 'name' => 'Box cell'),
	 	array('id' => 2, 'name' => 'Big cell'),
	);

	$boxes = $zh->getFreeBoxesByType(1);
	if ($boxes) {
		foreach ($boxes as $key => &$box) {
			if ($box["cell_box_ref_id"]) {
				unset($boxes[$key]);
			}
			$order_num = $box['order_num'] ? $box['order_num'] : "-";
			$box["name"] = $box['article'];
		}
	}


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
						 'onChange'=>"warehouse.loadRacksByWh(this.value);"
						 ) ),
					 'Rack'	=>	array( 'type'=>'select', 	'field'=>'rack_id', 		'params'=>array( 'list'=>$racks, 
						 'fieldValue'=>'id', 
						 'fieldTitle'=>'name', 
						 'currValue'=>$cardItem['rack_id'], 
						 'onChange'=>"warehouse.loadRowsByRack(this.value);"
						 ) ),
					 'Row'	=>	array( 'type'=>'select', 	'field'=>'row_id', 		'params'=>array( 'list'=>$rows, 
						 'fieldValue'=>'id', 
						 'fieldTitle'=>'fs_name', 
						 'currValue'=>$cardItem['row_id'], 
						 'onChange'=>"warehouse.loadSectionByRow(this.value);"
						 ) ),
					 'Section'	=>	array( 'type'=>'select', 	'field'=>'section_id', 		'params'=>array( 'list'=>$sections, 
						 'fieldValue'=>'id', 
						 'fieldTitle'=>'section_name', 
						 'currValue'=>$cardItem['section_id'], 
						 'onChange'=>""
						 ) ),
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 'Type'	=>	array( 'type'=>'select', 	'field'=>'type', 		'params'=>array( 'list'=>$cell_types, 
						 'fieldValue'=>'id', 
						 'fieldTitle'=>'name', 
						 'currValue'=>1, 
						 'onChange'=>"warehouse.changeCellType(this.value);"
						 ) ),
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 'Shelve'				=>	array( 'type'=>'number', 'field'=>'x', 'params'=>array( 'size'=>40, 'hold'=>'Shelve',  ) ),
					 'Level'				=>	array( 'type'=>'number', 'field'=>'y', 'params'=>array( 'size'=>40, 'hold'=>'Level',  ) ),
					 'Big cell levels'		=>	array( 'type'=>'number', 'field'=>'cell_size_y', 'params'=>array( 'size'=>40, 'hold'=>'Levels',  ) ),
					 'clear-3'				=>	array( 'type'=>'clear' ),
					 'Boxes'	=>	array( 'type'=>'select', 	'field'=>'box_id', 		'params'=>array( 'list'=>$boxes, 
						 'fieldValue'=>'id', 
						 'fieldTitle'=>'name', 
						 'currValue'=>1, 
						 'onChange'=>""
						 ) ),
					 'clear-4'				=>	array( 'type'=>'clear' ),
					 'Publish'			=>	array( 'type'=>'block', 'field'=>'block', 'params'=>array( 'reverse'=>true )),
					 'clear-5'				=>	array( 'type'=>'clear' ),
					 'Description'				=>	array( 'type'=>'area', 'field'=>'description', 'params'=>array( 'size'=>100, 'hold'=>'Description' ) ),					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createSection", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Cell create form</h3>";
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>