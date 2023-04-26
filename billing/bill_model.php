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
        <center><b>BILL NO.</b>0000001</center>
        <div style="text-align: left">
            -----------------------------------------------------------------------------------<br>
            <b>CLIENT DATA</b><br>
            <b>MR/MS: </b>ANDREW CUNANAN<br>
            <b>TIN: </b>123456789<br>
            <b>BILL DATE: </b>Floridablanca, 25 April 2023
            -----------------------------------------------------------------------------------<br>
            <b>From: </b>25/04/2023 <b>Time: </b>18:00<br>
            <b>To: </b>25/04/2023 <b>Time: </b>20:00<br>
            <b>Time spent: </b>2 hours<br>
            <b>SPOT NUMBER: </b>35
            -----------------------------------------------------------------------------------<br>
            <table border="1" cellpadding="2">
                <tr>
                    <td style="text-align: center" width="77px"><b>Detail</b></td>
                    <td style="text-align: center" width="55px"><b>Price</b></td>
                    <td style="text-align: center" width="45px"><b>Quantity</b></td>
                    <td style="text-align: center" width="55px"><b>Total</b></td>
                </tr>
                <tr>
                    <td style="text-align: center">2 hours parking service</td>
                    <td style="text-align: center">6000 COP</td>
                    <td style="text-align: center">1 vehicle</td>
                    <td style="text-align: center">6000 COP</td>
                </tr>
            </table>
            <p style="text-align: right"><b>Total Amount:</b> 6000 COP</p>
            <p style="text-align: left">Six thousand <b>Colombian pesos</b></p>
            -----------------------------------------------------------------------------------<br>
            <b>USER: </b>JUAN AMAYA DUARTE
            <p style="text-align: center">
                <img src="https://static.vecteezy.com/system/resources/previews/002/557/391/original/qr-code-for-scanning-free-vector.jpg" width="100px">
                <h5>A esta factura de venta aplican las normas relativas a la letra de cambio (artículo 5 Ley 1231 de 2008). Con esta, el comprador declara haber recibido real y materialmente las mercancías o prestación de servicios descritos en este título.</h5>
            </p>
        </div>
    </p>
</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+