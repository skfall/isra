<?php 
$lang_fields = $ah->getAvailableLangs();
$appTable = $_POST['appTable'];
$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);

$cardUpd = array(
				'name'			=> $_POST['name'],
				//'alias'			=> $_POST['alias'],
				'row_id'	=> (int)$_POST['row_id'],
				'size_x'	=> (int)$_POST['size_x'],
				'description'	=> $_POST['description'],
				'block'			=> $_POST['block'][0],
				'created'	=> date("Y-m-d H:i:s", time()),
				'modified'	=> date("Y-m-d H:i:s", time())
				);

$row_id = (int)$_POST['row_id'];

if(mb_strlen($cardUpd['name'])>0) {
	if ($row_id) {
		$curr_size = (int)$_POST["size_x"];
		$q = "SELECT M.size_x FROM `osc_wh_rows` AS M WHERE M.id = '$row_id' LIMIT 1";
		$available_size = $ah->rs($q);
		$available_size = (int)$available_size[0]["size_x"];

		$q = "SELECT SUM(size_x) AS total_size_sum FROM `osc_wh_sections` WHERE row_id = '$row_id'";
		$other_sections_size = $ah->rs($q);
		$other_sections_size = (int)$other_sections_size[0]["total_size_sum"];

		$available_size -= $other_sections_size;
		$diff = $available_size - $curr_size;

		if ($diff >= 0) {
			$query = "INSERT INTO `osc_wh_sections` ";				
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
				$data['message'] = "Section was successfully created.";
				$data['status'] = "success";
			}else{
				$data['item_id'] = 0;
			}
		}else{
			$data['status'] = "failed";
			$data['message'] = "There is no space for this section in selected row. Available space: ".$available_size." shelves.";
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Select row from list.";
	}
}else{
	$data['status'] = "failed";
	$data['message'] = "Enter section name.";
}