<?php 
	require_once "../../../require.base.php";
	$status = 'failed';
	$html = '';

	$new_users 		= $dbh->q('SELECT COUNT(id) as count FROM [pre]users WHERE `new`=1', 1);
	$new_orders 	= $dbh->q('SELECT COUNT(id) as count FROM [pre]o_orders WHERE `new`=1', 1);
	$new_contacts 	= $dbh->q('SELECT COUNT(id) as count FROM [pre]contact_form WHERE `viewed`=0', 1);
	$new_questions 	= $dbh->q('SELECT COUNT(id) as count FROM [pre]income_questions WHERE `viewed`=0', 1);

	if(
		$new_users['count'] ||
		$new_orders['count'] ||
		$new_contacts['count'] ||
		$new_questions['count']
	) {
		$status = 'success';
		ob_start(); ?>
			<table style="margin: 0;">
				<?php if($new_users['count']): ?>
					<tr>
						<td>Новых пользователей : </td>
						<td><?= $new_users['count'] ?></td>
					</tr>
				<?php endif; ?>
				<?php if($new_orders['count']): ?>
					<tr>
						<td>Новых заказов : </td>
						<td><?= $new_orders['count'] ?></td>
					</tr>
				<?php endif; ?>
				<?php if($new_contacts['count']): ?>
					<tr>
						<td>Новых сообщений : </td>
						<td><?= $new_contacts['count'] ?></td>
					</tr>
				<?php endif; ?>
				<?php if($new_questions['count']): ?>
					<tr>
						<td>Новых вопросов : </td>
						<td><?= $new_questions['count'] ?></td>
					</tr>
				<?php endif; ?>
			</table>
		<?php
		$html = ob_get_clean();
	}
	
	echo json_encode([
		'status' => $status,
		'html' => $html,
		'new_users' => $new_users,
		'new_orders' => $new_orders,
		'new_contacts' => $new_contacts,
		'new_questions' => $new_questions,
	]);

	
?>