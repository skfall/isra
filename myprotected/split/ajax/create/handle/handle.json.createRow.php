<?php 
$lang_fields = $ah->getAvailableLangs();
$appTable = $_POST['appTable'];
$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);
$cardUpd = array(
				'name'			=> $_POST['name'],
				//'alias'			=> $_POST['alias'],
				'rack_id'	=> (int)$_POST['rack_id'],
				'description'	=> $_POST['description'],
				'block'			=> $_POST['block'][0],
				'created'	=> date("Y-m-d H:i:s", time()),
				'modified'	=> date("Y-m-d H:i:s", time())
				);

$rack_id = (int)$_POST['rack_id'];

if(mb_strlen($cardUpd['name'])>1) {
	if ($rack_id) {
		$q = "SELECT M.* FROM `osc_wh_racks` AS M WHERE M.id = '$rack_id' LIMIT 1";
		$row_limit = $ah->rs($q);
		$row_limit = $row_limit[0]['rows_limit'];
		$q = "SELECT COUNT(id) as count FROM `osc_wh_rows` WHERE `rack_id` = '$rack_id' LIMIT 1";
		$current_rows_by_rack = $ah->rs($q);
		$current_rows_by_rack = $current_rows_by_rack[0]['count'];

		if ($current_rows_by_rack < $row_limit) {
			$query = "INSERT INTO `osc_wh_rows` ";				
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
				$data['message'] = "Row was successfully created.";
				$data['status'] = "success";
			}else{
				$data['item_id'] = 0;
			}
		}else{
			$data['status'] = "failed";
			$data['message'] = "Can`t create more than ".$row_limit." rows for this rack.";
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Select rack from list.";
	}
}else{
	$data['status'] = "failed";
	$data['message'] = "Enter row name.";
}