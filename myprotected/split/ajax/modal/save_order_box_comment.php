<?php 	//********************	//** WEB INSPECTOR	//********************		require_once "../../../require.base.php";		require_once "../../library/AjaxHelp.php";		$ah = new ajaxHelp($dbh);		$val		= str_replace("'","\'",strip_tags($_POST['val']));	$ref_id 	= (int)$_POST['ref_id'];		$action = (isset($_POST['action']) ? $_POST['action'] : "open");	$r = array('status'=>'success','message'=>'Комментарий сохранен','articel'=>0);			switch($action)	{		case 'save':						$q = "UPDATE [pre]o_orders_boxes SET `comment`='$val' WHERE `id`='$ref_id' LIMIT 1";			$ah->dbh->q($q,0,1);						echo json_encode($r); exit();			break;		default:break;	}