<?php 	//********************	//** WEB INSPECTOR	//********************		require_once "../../../require.base.php";		require_once "../../library/AjaxHelp.php";		$ah = new ajaxHelp($dbh);		$ordernum		= (int)$_POST['ordernum'];	$order_box_id	= (int)$_POST['order_box_id'];	$setThisBox 	= (int)$_POST['set'];	$action 		= (isset($_POST['action']) ? $_POST['action'] : "save");	$r = array('status'=>'success','message'=>'Комментарий сохранен','articel'=>0);			switch($action)	{		case 'save':						$q = "SELECT O.* FROM [pre]o_orders as O WHERE O.id=($ordernum-5000) LIMIT 1; ";			$order = $ah->dbh->q($q);			if(empty($order)) {				$r['status']='failed';				$r['message']='Заказ не найден';			} else {				$order_id = $order['id'];				$orderBoxes = $ah->dbh->q("SELECT `id` FROM [pre]o_orders_boxes WHERE `order_id`=$order_id LIMIT 1 ;", 1);				if(!empty($orderBoxes)&&in_array($order_box_id,array_column($orderBoxes,'id'))):					$description = json_decode($order['description'], true);					$boxes = &$description['boxes_return'];					if($setThisBox):						array_push($boxes, $order_box_id);						$ah->dbh->q("UPDATE [pre]o_orders_boxes SET `description`='".json_encode($description, JSON_UNESCAPED_UNICODE)."' WHERE `id`=$order_id ;", 0, 2);					else:						if(array_key_exists($order_box_id, $boxes)) unset($boxes[$order_box_id]);						$ah->dbh->q("UPDATE [pre]o_orders_boxes SET `description`='".json_encode($description, JSON_UNESCAPED_UNICODE)."' WHERE `id`=$order_id ;", 0, 2);					endif;				else:					$r['status']='failed';					$r['message']='Коробка не найдена в этом заказе';				endif;			}						echo json_encode($r); 			exit();			break;		default:break;	}