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
		$query = "SELECT M.* FROM `osc_wh_warehouses` as M WHERE `id`='$id' LIMIT 1";
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
					SELECT M.* 
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
			(SELECT W.name FROM `osc_wh_warehouses` AS W WHERE W.id = M.warehouse_id LIMIT 1) AS warehouse_name  
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
					(SELECT W.name FROM `osc_wh_warehouses` AS W WHERE W.id = M.warehouse_id LIMIT 1) AS warehouse_name 
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
			
	public function __destruct(){}
}
