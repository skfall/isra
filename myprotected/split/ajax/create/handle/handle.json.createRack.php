<?php 
$lang_fields = $ah->getAvailableLangs();
$appTable = $_POST['appTable'];
$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);
$cardUpd = array(
				'name'			=> $_POST['name'],
				'alias'			=> $_POST['alias'],
				'rows_limit'	=> (int)$_POST['rows_limit'],
				'warehouse_id'	=> (int)$_POST['warehouse_id'],
				'description'	=> $_POST['description'],
				'block'			=> $_POST['block'][0],
				'pos'			=> (int)$_POST['pos'],
				'created'	=> date("Y-m-d H:i:s", time()),
				'modified'	=> date("Y-m-d H:i:s", time())
				);



$query = "SELECT id FROM `osc_wh_racks` WHERE `alias`='".$cardUpd['alias']."' LIMIT 1";
$test_alias = $ah->rs($query);

if(mb_strlen($cardUpd['name'])>1) {
	if(!$test_alias) {
		if ($cardUpd['warehouse_id']) {
			if ($cardUpd['rows_limit'] && $cardUpd['rows_limit'] > 0) {
				$query = "INSERT INTO `osc_wh_racks` ";				
				$fieldsStr = " ( ";
				$valuesStr = " ( ";
				$cntUpd = 0;
				foreach($cardUpd as $field => $itemUpd) {
					$cntUpd++;
					$fieldsStr .= ($cntUpd==1 ? "`$field`" : ", `$field`");
					$valuesStr .= ($cntUpd==1 ? "'$itemUpd'" : ", '$itemUpd'");
				}
				$fieldsStr .= " ) ";
				$valuesStr .= " ) ";
				$query .= $fieldsStr." VALUES ".$valuesStr;
				$item_id = $ah->rs($query,0,1,1);	
				if ($item_id) {
					$data['item_id'] = $item_id;
					$data['message'] = "Rack was successfully created.";
					$data['status'] = "success";
				}else{
					$data['item_id'] = 0;
				}
			}else{
				$data['status'] = "failed";
				$data['message'] = "Enter rows quantity.";
			}
		}else{
			$data['status'] = "failed";
			$data['message'] = "Select warehouse from list.";
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Rack with this alias is already exists.";
	}
}else{
	$data['status'] = "failed";
	$data['message'] = "Enter rack name.";
}