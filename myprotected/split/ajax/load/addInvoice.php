<?php 
	require_once "../../../require.base.php";
	require_once "../../library/AjaxHelp.php";
	$ah = new ajaxHelp($dbh);

	$res = ['status'=>'failed'];
	$num = str_replace("'", "\'", strip_tags($_POST['num']));
	$date = date('Y-m-d H:i:s', strtotime($_POST['date']));
	$method = strip_tags($_POST['method']);
	$sum = (double)$_POST['sum'];
	$order = (int)$_POST['order'];
	$comment = str_replace("'", "\'", strip_tags($_POST['comment']));
	$now = date('Y-m-d H:i:s');

	$query = "
		INSERT INTO osc_o_orders_invoices (`order_id`, `invoice_num`, `comment`, `pay_method`, `pay_date`, `invoice_sum`, `is_payed`, `created`)
		VALUES ('$order', '$num','$comment','$method','$date','$sum','0','$now')
	";
	$invoice = $ah->rs($query);
	$invoices = $ah->rs("SELECT * FROM osc_o_orders_invoices WHERE `order_id`=$order ORDER BY `id` DESC");
	$res['query'] = $query;
?>

<?php if(!empty($invoices)): $res['status'] = 'success'; ob_start(); ?>
<tbody>
	<?php foreach($invoices as $n): ?>
		<tr>
			<td><?= date('d.m.Y', strtotime($n['pay_date'])) ?></td>
			<td><?= $n['invoice_num'] ?></td>
			<td><?= $n['pay_method'] ?></td>
			<td><?= $n['invoice_sum'] ?></td>
			<td><?= $n['comment'] ?></td>
			<td>
				<input type="checkbox" name="invoice_payed" id="invoice_payed" data-id="<?= $n['id'] ?>" style="width:30px; height: 30px;" onchange="changeInvoiceStatus()" <?= $n['is_payed'] ? 'checked' : '' ?>>
			</td>
			<td><button type="button" data-id="<?= $n['id'] ?>" onclick="removeInvoice(event)" style="height: 30px;border: 1px solid #b2b2b2;outline: none!important;border-radius: 3px;background: #dedede;">УДАЛИТЬ</button></td>
		</tr>
	<?php endforeach; ?>
</tbody>
<?php 
$res['table'] = ob_get_clean(); 
endif; 
echo json_encode($res);
?> 