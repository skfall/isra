<?php 
	require_once "../../../../require.base.php";
	require_once "../../../library/AjaxHelp.php";
	$ah = new ajaxHelp($dbh);
	$content_id = isset($content_id) ? $content_id : 0;
	$invoices = $ah->rs("SELECT * FROM osc_o_orders_invoices WHERE `order_id`=$content_id ORDER BY `id` DESC");
	$order = $ah->rs("SELECT * FROM osc_o_orders WHERE `id`=$content_id LIMIT 1", 1);
	$total = $order['total'];
	$payed = array_sum(array_map(function($e) {
		return $e['is_payed'] ? $e['invoice_sum'] : 0;
	}, $invoices));
	$debt = $total - $payed;
?>
<div>
   	<div class='zen-form-item' style="width:100%;">
   		<h2 style="font-size: 20px; padding: 5px;">Новый инвойс</h2>
		<div class='zif-wrap-date' style="text-align: left; float: left; width: 24%;">
			<label>Номер инвойса</label><br>
        	<input id='invoice_num' class='my-field' type='text' value='' name='invoice_num' style="width: 80%;margin-top: 8px;" />
        	<input id='invoice_order' class='my-field' type='hidden' value='<?= $content_id ?>' name='invoice_order' style="width: 80%;margin-top: 8px;" />
        </div>   		
		<div class='zif-wrap-date' style="text-align: left; float: left; width: 24%;">
			<label>Дата платежа</label><br>
        	<input id='invoice_date' class='my-field dateJQ' type='text' value='' name='invoice_date' style="width: 80%;margin-top: 8px;" />
        </div>		
		<div class='zif-wrap-date' style="text-align: left; float: left; width: 24%;">
			<label>Способ платежа</label><br>
			<div class="zif-wrap-select styled-select" style="width:80%;">  
				<select style="width:100%;" class="sampling_changed" id="invoice_method" name="invoice_method" onchange="">
					<option value="Оплата картой">Оплата картой</option>
					<option value="Банковский перевод">Банковский перевод</option>
					<option value="Наличный расчет">Наличный расчет</option>
				</select>
			</div>
		</div>
		<div class='zif-wrap-date' style="text-align: left; float: left; width: 24%;">
			<label>Сумма платежа</label><br>
        	<input id='invoice_sum' class='my-field' type='text' value='<?= $debt ?>' name='invoice_sum' style="width: 80%;margin-top: 8px;" />
        </div>
        <div class="clear"></div>
		<div class='zif-wrap'>
			<label for='save-$name'>Комментарий</label><br>
			<textarea name="invoice_comment" id="invoice_comment" cols="30" rows="4" class="my-txtarea"></textarea>
    	</div>
		<button class="btn btn-default btn-md" onclick="addInvoice();" style="margin-top: 10px;" type="button">SAVE</button>
	</div>
    	
    <div class='clear'></div>		
	<style>
		table#invoices-table td, table#invoices-table th{ border:1px solid #686868; padding: 2px 5px; text-align: center;vertical-align: middle;}
		table#invoices-table thead{background: #57677e;color: #fff;}
	</style>
	<table id="invoices-table" style="width: 96%; margin:2%;">
		<thead>
			<tr>
				<th>Дата</th>
				<th>Номер</th>
				<th>Метод оплаты</th>
				<th>Сумма</th>
				<th>Комментарий</th>
				<th>Статус оплаты</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
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
	</table>
</div>

<script>
	$( "input.dateJQ" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '2015:2030'
	});	
	function addInvoice() {
		var req = {};
		req.num = $('#invoice_num').val(); 
		req.date = $('#invoice_date').val(); 
		req.method = $('#invoice_method option:selected').val(); 
		req.sum = $('#invoice_sum').val(); 
		req.comment = $('#invoice_comment').val(); 
		req.order = $('#invoice_order').val(); 

		if(!req.num.length) return $('#invoice_num').focus();

		$.post('split/ajax/load/addInvoice.php', req, function(r) {
			var res = JSON.parse(r);
			if(res.status=='success') {
				$('#invoices-table tbody').replaceWith(res.table);
			}
		});
	}
	function changeInvoiceStatus() {
		var id = $(event.target).attr('data-id');
		var status = $(event.target).is(':checked') ? 1 : 0;
		$.post('split/ajax/load/changeInvoiceStatus.php', {id:id, status:status}, function(r) {
			var res = JSON.parse(r);
			if(res.status!='success') {
				event.preventDefault();
			}
		});
	}
	function removeInvoice(e) {
		var id = $(e.target).attr('data-id');
		$.post('split/ajax/load/removeInvoice.php', {id:id}, function(r) {
			var res = JSON.parse(r);
			if(res.status=='success') {
				$(e.target).parents('tr').remove();
			}
		});		
	}
</script>