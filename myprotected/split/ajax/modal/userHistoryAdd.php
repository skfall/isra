<?php 
	require_once "../../../require.base.php";
	require_once "../../library/AjaxHelp.php";
	$ah = new ajaxHelp($dbh);

	$id 	= $_POST['id'];
	$note = str_replace("'", "\'", strip_tags($_POST['note']));
	$date 	= strlen($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : '';
	if(strlen(trim($note))) {
		$now 	= date('Y-m-d H:i:s');
		$admin_id = ADMIN_ID;
		$ins = $ah->dbh->q("INSERT INTO [pre]alt_users_notes (`alt_user_id`, `note`, `admin_id`, `created`, `call_at`) VALUES ('$id', '$note', '$admin_id', '$now', '$date')",0,1);
		echo json_encode(['status'=>'success']);
	}
?>