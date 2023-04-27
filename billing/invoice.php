<?php
// Include the main TCPDF library (search for installation path).
require_once('../app/templates/TCPDF-main/tcpdf.php');
include('../app/config.php');

//Loading Header
$query_infos = $pdo->prepare("SELECT * FROM tb_infos");
$query_infos->execute();
$infos = $query_infos->fetchAll(PDO::FETCH_ASSOC);
foreach ($infos as $info) {
    $id_info = $info['ID_INFO'];
    $b_name = $info['B_NAME'];
    $b_activity = $info['B_ACTIVITY'];
    $b_address = $info['B_ADDRESS'];
    $b_area = $info['B_AREA'];
    $b_department = $info['B_DEPARTMENT'];
    $b_nation = $info['B_NATION'];
    $b_tel = $info['B_TEL'];
}
//Retrieving invoice data
$query_invoices = $pdo->prepare("SELECT * FROM tb_billing");
$query_invoices->execute();
$invoices = $query_invoices->fetchAll(PDO::FETCH_ASSOC);
foreach ($invoices as $invoice) {
    $id_invoice = $invoice['ID_BILL'];
    $id_info_invoice = $invoice['ID_INFO'];
    $id_client_invoice = $invoice['ID_CLIENT'];			
    $date_invoice = $invoice['BILL_DATE'];
    $entry_date_invoice = $invoice['ENTRY_DATE'];
    $exit_date_invoice = $invoice['EXIT_DATE'];
    $entry_time_invoice = $invoice['ENTRY_TIME'];
    $exit_time_invoice = $invoice['EXIT_TIME'];
    $s_number_invoice = $invoice['S_NUMBER'];
    $detail_invoice = $invoice['DETAIL'];
    $price_invoice = $invoice['PRICE'];
    $amount_invoice = $invoice['AMOUNT'];
    $total_invoice = $invoice['TOTAL'];
    $total_amount_invoice = $invoice['TOTAL_AMOUNT'];
    $u_session_invoice = $invoice['U_SESSION'];
    $qr_invoice = $invoice['QR'];
}
$time_spent = substr($detail_invoice, 0, -16);

//Retrieving client data
$query_clients = $pdo->prepare("SELECT FULLNAME_CLIENT, TIN_CLIENT, CAR_PLATE FROM tb_clients WHERE ID_CLIENT = '$id_client_invoice'");
$query_clients->execute();
$clients = $query_clients->fetchAll(PDO::FETCH_ASSOC);
foreach ($clients as $client) {
    $c_fullname = $client['FULLNAME_CLIENT'];
    $c_tin = $client['TIN_CLIENT'];
    $car_plate = $client['CAR_PLATE'];
}
//Retrieving client data
$query_prices = $pdo->prepare("SELECT CURRENCY FROM tb_prices WHERE P_VALUE = '$price_invoice'");
$query_prices->execute();
$prices = $query_prices->fetchAll(PDO::FETCH_ASSOC);
foreach ($prices as $price) {
    $currency = $price['CURRENCY'];
}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79,160), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('AJ-Building');
$pdf->setTitle('Parking System');
$pdf->setSubject('Parking System');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5, 5, 5);

// set auto page breaks
$pdf->setAutoPageBreak(FALSE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 7);

// add a page
$pdf->AddPage();

$html = '
<div>
    <p style="text-align: center">
        <b>'.$b_name.'</b><br>
        '.$b_activity.'<br>
        '.$b_area.'<br>
        '.$b_address.'<br>
        '.$b_department.' - '.$b_nation.'<br>
        Tel. '.$b_tel.'
        <p style="text-align: left">-----------------------------------------------------------------------------------</p>
        <center><b>INVOICE NO.</b>'.$id_invoice.'</center>
        <div style="text-align: left">
            -----------------------------------------------------------------------------------<br>
            <b>CLIENT DATA</b><br>
            <b>MR/MS: </b>'.$c_fullname.'<br>
            <b>TIN: </b>'.$c_tin.'<br>
            <b>BILL DATE: </b>'.$b_department.', '.$date_invoice.'
            -----------------------------------------------------------------------------------<br>
            <b>From: </b>'.$entry_date_invoice.'<b> Time: </b>'.$entry_time_invoice.'<br>
            <b>To: </b>'.$exit_date_invoice.'<b> Time: </b>'.$exit_time_invoice.'<br>
            <b>Time spent: </b>'.$time_spent.'<br>
            <b>SPOT NUMBER: </b>'.$s_number_invoice.'
            -----------------------------------------------------------------------------------<br>
            <table border="1" cellpadding="2">
                <tr>
                    <td style="text-align: center" width="77px"><b>Detail</b></td>
                    <td style="text-align: center" width="55px"><b>Price</b></td>
                    <td style="text-align: center" width="45px"><b>Quantity</b></td>
                    <td style="text-align: center" width="55px"><b>Total</b></td>
                </tr>
                <tr>
                    <td style="text-align: center">'.$detail_invoice.'</td>
                    <td style="text-align: center">'.$price_invoice.' '.$currency.'</td>
                    <td style="text-align: center">'.$amount_invoice.' vehicle</td>
                    <td style="text-align: center">'.$total_invoice.' '.$currency.'</td>
                </tr>
            </table>
            <p style="text-align: right"><b>Total Amount:</b>'.$total_amount_invoice.' '.$currency.'</p>
            -----------------------------------------------------------------------------------<br>
            <b>USER: </b>'.$u_session_invoice.'<br><br><br><br><br><br><br><br><br><br><br>
            <p style="text-align: center">
                <h5>A esta factura de venta aplican las normas relativas a la letra de cambio (artículo 5 Ley 1231 de 2008). Con esta, el comprador declara haber recibido real y materialmente las mercancías o prestación de servicios descritos en este título.</h5>
            </p>
        </div>
    </p>
</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

// QRCODE,L : QR-CODE Low error correction
$pdf->write2DBarcode($qr_invoice, 'QRCODE,L', 22, 110, 35, 35, $style);

//Close and output PDF document
$pdf->Output('Invoice.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+