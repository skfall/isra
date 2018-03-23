<?php 
	//********************
	//** WEB INSPECTOR
	//********************
	
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$ah = new ajaxHelp($dbh);
	
	$order_id	= (int)$_POST['order_id'];
	
	$ref_id 		= (int)$_POST['ref_id'];
	
	$action = (isset($_POST['action']) ? $_POST['action'] : "open");

	$r = array('status'=>'success','message'=>'Товар удален','articel'=>0);
		
	switch($action)
	{
		case 'delete':
			
			$q = "DELETE FROM [pre]o_orders_extras WHERE `id`='$ref_id' LIMIT 1";
			$ah->dbh->q($q,0,1);
			
			echo json_encode($r); exit();
			break;
		default:break;
	}