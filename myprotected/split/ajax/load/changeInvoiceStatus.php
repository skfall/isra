<?php 
	require_once "../../../require.base.php";
	require_once "../../library/AjaxHelp.php";
	$ah = new ajaxHelp($dbh);

	$res = ['status'=>'failed'];
	$id = (int)$_POST['id'];
	$status = (int)$_POST['status'];

	$query = "
		UPDATE osc_o_orders_invoices SET `is_payed` = $status WHERE `id` = $id
	";
	$invoice = $ah->rs($query);
	$res['status'] = 'success';
	echo json_encode($res);
?> 