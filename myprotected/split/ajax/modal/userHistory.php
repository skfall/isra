<?php 
	require_once "../../../require.base.php";
	require_once "../../library/AjaxHelp.php";
	$ah = new ajaxHelp($dbh);

	$id 	= $_POST['id'];
	$lpx 	= $_POST['lpx'];
	$notes = $ah->dbh->q("
		SELECT *,
		(SELECT CONCAT('(',`id`,') ',`name`,' ',`fname`) FROM [pre]users WHERE `id`=osc_alt_users_notes.admin_id LIMIT 1) as admin
		FROM [pre]alt_users_notes WHERE `alt_user_id`=$id
	", 0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>USERS HISTORY</title>
	</head>

	<body>
		<button class="close-modal" onclick="close_modal();">Закрыть окно</button>
		<div class='clear'></div>
       		<div class='zen-form-item' style="width:96%; margin: 2%;">
				<label for='save-$name'><h3>Добавить заметку</h3></label><br>
				<div class='zif-wrap'>
					<textarea name="alt-user-note" id="alt-user-note" cols="30" rows="10" class="my-txtarea redactor"></textarea>
            	</div>
				<div class='zif-wrap-date' style="text-align: left;">
					<label>Срок исполнения</label><br>
                	<input id='alt-user-date' class='my-field dateJQ' type='text' value='' name='alt-user-date' />
                </div>
				<button class="btn btn-default btn-md" onclick="addAltUserNote();" style="margin-top: 10px;">SAVE</button>
        	</div>
        	
        <div class='clear'></div>		
		<h3>Заметки</h3>
		<?php if(!empty($notes)): ?>
			<style>
				table#notes-table td, table#notes-table th{ border:1px solid #686868; padding: 2px 5px;}
			</style>
			<table id="notes-table" style="width: 96%; margin:2%;">
				<thead>
					<tr>
						<th>Дата</th>
						<th>Админ</th>
						<th>Заметка</th>
						<th>Связаться</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($notes as $n): ?>
						<tr>
							<td><?= date('d.m.Y H:i', strtotime($n['created'])) ?></td>
							<td><?= $n['admin'] ?></td>
							<td><?= $n['note'] ?></td>
							<td><?= strlen($n['call_at']) ? date('d/m/Y', strtotime($n['call_at'])) : ' - ' ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</body>
</html>

<script>
	$('.redactor').redactor({
		imageUpload: 'redactor/demo/scripts/image_upload.php',
		convertDivs: false
	});	
	$( "input.dateJQ" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '2015:2030'
	});	
	function addAltUserNote() {
		var note = $('#alt-user-note').val(); 
		var date = $('#alt-user-date').val(); 
		$.post('split/ajax/modal/userHistoryAdd.php', { id:<?= $id ?>, note:note, date:date }, function(res) {
			open_modal('split/ajax/modal/userHistory.php', { id:<?= $id ?>, lpx:<?= $lpx ?> });
		});
	}
</script>