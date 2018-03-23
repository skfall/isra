<?php 
    function buildRandomString($length = 6) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) $randomString .= $chars[rand(0, $charsLength - 1)];
        return $randomString;
    }

	require_once "../../../require.base.php";
	require_once "../../library/AjaxHelp.php";
	$ah = new ajaxHelp($dbh);

	$message = '';
	$id 	= $_POST['id'];
	$uid 	= 0;
	$now 	= date('Y-m-d H:i:s');
	$user = $ah->dbh->q("SELECT * FROM [pre]alt_users WHERE `id` = $id LIMIT 1", 1);
	$pass = buildRandomString(7);

	if(!empty($user)) {
		$user['alt_user'] = $user['id'];
		$user['pass'] = md5($pass);
		$user['email'] = $user['login'];
		$user['block'] = 0;
		unset($user['id']);
		unset($user['num']);
		unset($user['comment']);
		unset($user['activity']);
		unset($user['locale']);


		$userExists = $ah->dbh->q("SELECT * FROM [pre]users WHERE `login` = '".trim($user['login'])."' LIMIT 1", 1);

		if(empty($userExists)) {
			$query = "INSERT INTO [pre]users ";
			$fieldsStr = " ( ";
			$valuesStr = " ( ";
			$cntUpd = 0;
			foreach($user as $field => $value) {
				$cntUpd++;
				$fieldsStr .= ($cntUpd==1 ? "`$field`" : ", `$field`");
				$valuesStr .= ($cntUpd==1 ? "'$value'" : ", '$value'");
			}
			$fieldsStr .= " ) ";
			$valuesStr .= " ) ";
			$query .= $fieldsStr." VALUES ".$valuesStr;
			$ins = $ah->dbh->q($query,0,1,1);

			if($ins) {
				$uid = $ins;
				$ah->dbh->q("UPDATE [pre]alt_users SET `block`=0 WHERE `id` = $id LIMIT 1", 0, 1);
			}
		} else {
			$ah->dbh->q("UPDATE [pre]alt_users SET `block`=0 WHERE `id` = $id LIMIT 1", 0, 1);
			$message = 'Пользователь с этим email уже создан или перенесен';
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>USERS HISTORY</title>
	</head>

	<body>
		<button class="close-modal" onclick="close_modal();">Закрыть окно</button>
		<?php if($message): ?>
			<h2><?= $message ?></h2>
			<h3>ID пользователя : <strong><?= $userExists['id'] ?></strong></h3>
			<h3>Логин : <strong><?= $userExists['login'] ?></strong></h3>
		<?php else: ?>
			<h2>Пользователь добавлен</h2>
			<h3>Новый ID пользователя : <strong><?= $uid ?></strong></h3>
			<h3>Логин : <strong><?= $user['login'] ?></strong></h3>
			<h3>Пароль : <strong><?= $pass ?></strong></h3>
			<script>
				eval("$.post('/ajax/',{action:'register-message', email:'<?= $user['login'] ?>', pass:'<?= $pass ?>', locale:$('#save-locale option:selected').val() },function(data,status){},'json');");
			</script>
		<?php endif; ?>
	</body>
</html>