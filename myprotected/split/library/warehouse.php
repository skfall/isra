<?php
	/*	KLYCHA WEB TECHNOLOGIES	*/
	/*	***************************	*/
	/*	Author: Sivkovich Maxim		*/
	/*	***************************	*/
	/*	Developed: from 2013		*/
	/*	***************************	*/
	
	// Settings class
	
require("BasicHelp.php");
class Warehouse extends BasicHelp {
		public $dbh;
	public $table;
	public $id;
	public $item;
	
	public function __construct($dbh){
		parent::__construct($dbh);
		$this->dbh = $dbh;
	} 

	
	public function getWarehouseItem($id) {
		$query = "SELECT M.*, 
		(SELECT COUNT(id) as racks_count FROM `osc_wh_racks` WHERE warehouse_id = M.id LIMIT 1) as racks_count
		 FROM `osc_wh_warehouses` as M WHERE `id`='$id' LIMIT 1";
		$resultMassive = $this->rs($query);
		$result = ($resultMassive ? $resultMassive[0] : array());
		return $result;
	}

	
	public function getWarehouses($params=array(),$typeCount=false) {
		$filter_and = "";
		if(isset($params['filtr']['massive'])) {
			foreach($params['filtr']['massive'] as $f_name => $f_value) {
				if($f_value < 0) continue;
				$filter_and .= " AND ($f_name='$f_value') ";
			}
		}
		if(isset($params['filtr']['filtr_search_key']) && isset($params['filtr']['filtr_search_field']) && trim($params['filtr']['filtr_search_key']) != "") {
			$search_field = $params['filtr']['filtr_search_field'];
			$search_key = $params['filtr']['filtr_search_key'];
			$filter_and .= " AND ($search_field LIKE '%$search_key%') ";
		}
		$sort_field		= (isset($params['filtr']['sort_filtr']) ? $params['filtr']['sort_filtr'] : "M.id");
		$sort_vector	= (isset($params['filtr']['order_filtr']) ? $params['filtr']['order_filtr'] : "");			
		$limit = (isset($_COOKIE['global_on_page']) ? (int)$_COOKIE['global_on_page'] : GLOBAL_ON_PAGE);
		if($limit <= 0) $limit = GLOBAL_ON_PAGE;
		$start = (isset($params['start']) ? ($params['start']-1)*$limit : 0);
		if(!$typeCount)	{
			$query = "
					SELECT M.*,
					(SELECT COUNT(id) as racks_count FROM `osc_wh_racks` WHERE warehouse_id = M.id LIMIT 1) as racks_count
					FROM `osc_wh_warehouses` as M  
					WHERE 1 $filter_and 
					ORDER BY $sort_field $sort_vector 
					LIMIT $start,$limit
			";
			return $this->rs($query);
		}else{
			$query = "
					SELECT COUNT(*) 
					FROM `osc_wh_warehouses` as M 
					WHERE 1 $filter_and 
					LIMIT 100000
			";
			$result = $this->rs($query);
			return $result[0]['COUNT(*)'];
		}
	}

	public function getWarehousesList(){
		$query = "SELECT M.* FROM `osc_wh_warehouses` as M";
		return $this->rs($query);
	}

	public function getRacksItem($id) {
		$query = "
			SELECT M.*, 
			(SELECT W.name FROM `osc_wh_warehouses` AS W WHERE W.id = M.warehouse_id LIMIT 1) AS warehouse_name  ,
			(SELECT COUNT(id) FROM `osc_wh_rows` WHERE rack_id = M.id LIMIT 1) AS rows_count  
			FROM `osc_wh_racks` as M WHERE `id`='$id' LIMIT 1
		";
		$resultMassive = $this->rs($query);
		$result = ($resultMassive ? $resultMassive[0] : array());
		return $result;
	}

	
	public function getRacks($params=array(),$typeCount=false) {
		$filter_and = "";
		if(isset($params['filtr']['massive'])) {
			foreach($params['filtr']['massive'] as $f_name => $f_value) {
				if($f_value < 0) continue;
				$filter_and .= " AND ($f_name='$f_value') ";
			}
		}
		if(isset($params['filtr']['filtr_search_key']) && isset($params['filtr']['filtr_search_field']) && trim($params['filtr']['filtr_search_key']) != "") {
			$search_field = $params['filtr']['filtr_search_field'];
			$search_key = $params['filtr']['filtr_search_key'];
			$filter_and .= " AND ($search_field LIKE '%$search_key%') ";
		}
		$sort_field		= (isset($params['filtr']['sort_filtr']) ? $params['filtr']['sort_filtr'] : "M.id");
		$sort_vector	= (isset($params['filtr']['order_filtr']) ? $params['filtr']['order_filtr'] : "");			
		$limit = (isset($_COOKIE['global_on_page']) ? (int)$_COOKIE['global_on_page'] : GLOBAL_ON_PAGE);
		if($limit <= 0) $limit = GLOBAL_ON_PAGE;
		$start = (isset($params['start']) ? ($params['start']-1)*$limit : 0);
		if(!$typeCount)	{
			$query = "
					SELECT M.* ,
					(SELECT W.name FROM `osc_wh_warehouses` AS W WHERE W.id = M.warehouse_id LIMIT 1) AS warehouse_name ,
					(SELECT COUNT(id) FROM `osc_wh_rows` WHERE rack_id = M.id LIMIT 1) AS rows_count  
					FROM `osc_wh_racks` as M  
					WHERE 1 $filter_and 
					ORDER BY $sort_field $sort_vector 
					LIMIT $start,$limit
			";
			return $this->rs($query);
		}else{
			$query = "
					SELECT COUNT(*) 
					FROM `osc_wh_racks` as M 
					WHERE 1 $filter_and 
					LIMIT 100000
			";
			$result = $this->rs($query);
			return $result[0]['COUNT(*)'];
		}
	}

	public function getRowsItem($id) {
		$query = "
			SELECT M.*, 
			(SELECT R.warehouse_id FROM `osc_wh_racks` AS R WHERE R.id = M.rack_id LIMIT 1) AS rack_wh ,
			(SELECT R.name FROM `osc_wh_racks` AS R WHERE R.id = M.rack_id LIMIT 1) AS rack_name ,
			(SELECT W.name FROM `osc_wh_warehouses` AS W WHERE W.id = rack_wh LIMIT 1) AS warehouse_name
			FROM `osc_wh_rows` as M WHERE `id`='$id' LIMIT 1
		";
		$resultMassive = $this->rs($query);
		$result = ($resultMassive ? $resultMassive[0] : array());
		return $result;
	}

	
	public function getRows($params=array(),$typeCount=false) {
		$filter_and = "";
		if(isset($params['filtr']['massive'])) {
			foreach($params['filtr']['massive'] as $f_name => $f_value) {
				if($f_value < 0) continue;
				$filter_and .= " AND ($f_name='$f_value') ";
			}
		}
		if(isset($params['filtr']['filtr_search_key']) && isset($params['filtr']['filtr_search_field']) && trim($params['filtr']['filtr_search_key']) != "") {
			$search_field = $params['filtr']['filtr_search_field'];
			$search_key = $params['filtr']['filtr_search_key'];
			$filter_and .= " AND ($search_field LIKE '%$search_key%') ";
		}
		$sort_field		= (isset($params['filtr']['sort_filtr']) ? $params['filtr']['sort_filtr'] : "M.id");
		$sort_vector	= (isset($params['filtr']['order_filtr']) ? $params['filtr']['order_filtr'] : "");			
		$limit = (isset($_COOKIE['global_on_page']) ? (int)$_COOKIE['global_on_page'] : GLOBAL_ON_PAGE);
		if($limit <= 0) $limit = GLOBAL_ON_PAGE;
		$start = (isset($params['start']) ? ($params['start']-1)*$limit : 0);
		if(!$typeCount)	{
			$query = "
					SELECT M.* , 
					(SELECT R.warehouse_id FROM `osc_wh_racks` AS R WHERE R.id = M.rack_id LIMIT 1) AS rack_wh ,
					(SELECT R.name FROM `osc_wh_racks` AS R WHERE R.id = M.rack_id LIMIT 1) AS rack_name ,
					(SELECT W.name FROM `osc_wh_warehouses` AS W WHERE W.id = rack_wh LIMIT 1) AS warehouse_name 
					FROM `osc_wh_rows` as M  
					WHERE 1 $filter_and 
					ORDER BY $sort_field $sort_vector 
					LIMIT $start,$limit
			";

			return $this->rs($query);
		}else{
			$query = "
					SELECT COUNT(*) 
					FROM `osc_wh_rows` as M 
					WHERE 1 $filter_and 
					LIMIT 100000
			";
			$result = $this->rs($query);
			return $result[0]['COUNT(*)'];
		}
	}

	public function getRacksList($wh_id = 1){
		$query = "SELECT M.* FROM `osc_wh_racks` as M WHERE M.warehouse_id = '$wh_id'";
		return $this->rs($query);
	}

	public function getSectionsItem($id) {
		$query = "
			SELECT M.*, 
			(SELECT ROW.rack_id FROM `osc_wh_rows` AS ROW WHERE ROW.id = M.row_id LIMIT 1) AS rack_id,
			(SELECT ROW.name FROM `osc_wh_rows` AS ROW WHERE ROW.id = M.row_id LIMIT 1) AS row_name,
			(SELECT RACK.name FROM `osc_wh_racks` AS RACK WHERE RACK.id = rack_id LIMIT 1) AS rack_name, 
			(SELECT RACK.warehouse_id FROM `osc_wh_racks` AS RACK WHERE RACK.id = rack_id LIMIT 1) AS warehouse_id, 
			(SELECT W.name FROM `osc_wh_warehouses` AS W WHERE W.id = warehouse_id LIMIT 1) AS warehouse_name
			FROM `osc_wh_sections` as M WHERE `id`='$id' LIMIT 1
		";
		$resultMassive = $this->rs($query);
		$result = ($resultMassive ? $resultMassive[0] : array());
		return $result;
	}

	
	public function getSections($params=array(),$typeCount=false) {
		$filter_and = "";
		if(isset($params['filtr']['massive'])) {
			foreach($params['filtr']['massive'] as $f_name => $f_value) {
				if($f_value < 0) continue;
				$filter_and .= " AND ($f_name='$f_value') ";
			}
		}
		if(isset($params['filtr']['filtr_search_key']) && isset($params['filtr']['filtr_search_field']) && trim($params['filtr']['filtr_search_key']) != "") {
			$search_field = $params['filtr']['filtr_search_field'];
			$search_key = $params['filtr']['filtr_search_key'];
			$filter_and .= " AND ($search_field LIKE '%$search_key%') ";
		}
		$sort_field		= (isset($params['filtr']['sort_filtr']) ? $params['filtr']['sort_filtr'] : "M.id");
		$sort_vector	= (isset($params['filtr']['order_filtr']) ? $params['filtr']['order_filtr'] : "");			
		$limit = (isset($_COOKIE['global_on_page']) ? (int)$_COOKIE['global_on_page'] : GLOBAL_ON_PAGE);
		if($limit <= 0) $limit = GLOBAL_ON_PAGE;
		$start = (isset($params['start']) ? ($params['start']-1)*$limit : 0);
		if(!$typeCount)	{
			$query = "
					SELECT M.* ,
					(SELECT ROW.rack_id FROM `osc_wh_rows` AS ROW WHERE ROW.id = M.row_id LIMIT 1) AS rack_id,
					(SELECT ROW.name FROM `osc_wh_rows` AS ROW WHERE ROW.id = M.row_id LIMIT 1) AS row_name,
					(SELECT RACK.name FROM `osc_wh_racks` AS RACK WHERE RACK.id = rack_id LIMIT 1) AS rack_name, 
					(SELECT RACK.warehouse_id FROM `osc_wh_racks` AS RACK WHERE RACK.id = rack_id LIMIT 1) AS warehouse_id, 
					(SELECT W.name FROM `osc_wh_warehouses` AS W WHERE W.id = warehouse_id LIMIT 1) AS warehouse_name
					FROM `osc_wh_sections` as M  
					WHERE 1 $filter_and 
					ORDER BY $sort_field $sort_vector 
					LIMIT $start,$limit
			";

			return $this->rs($query);
		}else{
			$query = "
					SELECT COUNT(*) 
					FROM `osc_wh_sections` as M 
					WHERE 1 $filter_and 
					LIMIT 100000
			";
			$result = $this->rs($query);
			return $result[0]['COUNT(*)'];
		}
	}

	public function getRowsList($rack_id = 1){
		$query = "SELECT M.* FROM `osc_wh_rows` as M WHERE M.rack_id = '$rack_id'";
		return $this->rs($query);
	}

	public function getAvailableShelvesForRow($row_size, $row_id){
		$q = "SELECT SUM(size_x) AS total_size_sum FROM `osc_wh_sections` WHERE row_id = '$row_id'";
		$other_sections_size = $this->rs($q);
		$other_sections_size = (int)$other_sections_size[0]["total_size_sum"];
		$available = (int)$row_size - $other_sections_size;
		return $available;
	}
			
	public function __destruct(){}
}
