<?php
	require_once "../../../require.base.php";
	require_once "../../library/AjaxHelp.php";
	require_once "../../library/shop.class.php";
	$sh = new shopHelp($dbh);
	$ah = new ajaxHelp($dbh);
	
	$order_id	= (int)$_POST['order_id'];
	$kind_id	= (int)$_POST['kind_id'];
	$action = (isset($_POST['action']) ? $_POST['action'] : "open");
	$r = array('status'=>'failed','message'=>'Error occured');
	
	if(in_array($kind_id, [1,3])):
		$orderData = $sh->getOrdersItem($order_id);
	elseif($kind_id == 2):
		$orderData = $sh->getPalletsOrdersItem($order_id);
	else:
		$orderData = $sh->getReturnOrdersItem($order_id);
	endif;

	$settings = $ah->rs("SELECT `delivery_sum` FROM [pre]o_prices LIMIT 1", 1);
	$orderData['delivery_price'] = $settings['delivery_sum'];

	$pdf = generate_PDF($orderData);
	function generate_PDF($order) {
        require_once "../../library/tcpdf/tcpdf.php";
		class MYPDF extends TCPDF {
		    public function Header() {
		        $this->SetY(5);
		        $this->SetX(5);
		        $this->SetFont('freeserif', '', 10);
		        $this->Cell(0, 10, ''.$this->getAliasNumPage(), 0, false, 'L', 0, '', 0, false, 'T', 'M');
		    }			
		    public function Footer() {
		        $this->SetY(-15);
		        $this->SetFont('freeserif', '', 8);
		        $this->Cell(0, 10, 'חתימת לקוח _________________', 0, false, 'R', 0, '', 0, false, 'T', 'M');
		        $this->Cell(0, 10, 'חותמת החברה וחתימת נציג החברה ____________________', 0, false, 'L', 0, '', 0, false, 'T', 'M');
		    }
		}        
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator('KAM-Studio');
        $pdf->SetAuthor('KAM-Studio');
        $pdf->SetKeywords('');
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
		$fontname = TCPDF_FONTS::addTTFfont('VarelaRound.ttf', 'TrueTypeUnicode', '', 96);
		$pdf->SetFont($fontname, '', 10, '', false);        
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->SetMargins(10, 15, 10, true);
        $pdf->AddPage();
        $pdf->setRTL ( true );
		$pdf->setLanguageArray([
			'a_meta_charset' => 'UTF-8',
			'a_meta_dir' => 'rtl',
			'a_meta_language' => 'he',
			'w_page' => 'page',
		]);

        /** HTML */
		ob_start();
		include_once "build_order_pdf_html_he.php";
  		$html = ob_get_clean();
        /** HTML */

		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
		$root_adr = getcwd();
		$filename = "order_".((int)$order['id']).".pdf";
		$filepath = $root_adr."/pdf/".$filename;
		if(file_exists("pdf/$filename")) unlink("pdf/$filename");

		$pdf->Output($filepath, 'F'); 
		return $filename;
	}	
	
?>
<!DOCTYPE>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SET BOX TO ORDER PLACE SCRIPT</title>
</head>

<body>
	<button class="close-modal" onClick="close_modal();">Закрыть окно</button>
    <div class="modalW" id="modalW-1">
    	<h4>PDF документ по заказу #<?= $order_id ?>: </h4>
    		<a href="/myprotected/split/ajax/modal/pdf/<?= $pdf ?>" target="_blank">ПРОСМОТР [<?= $pdf ?>]</a>
		
			<?php /* foreach ($orderData as $key => $value): ?>
					<p><strong><?= $key ?></strong> <i><?php var_dump($value) ?></i></p>
			<?php endforeach ; */ ?>
        
        <div id="set_box_response"></div>
    </div>
</body>
</html>

