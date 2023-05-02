<?php
require_once('../app/templates/TCPDF-main/tcpdf.php');
include('../app/config.php');

$query_infos = $pdo->prepare("SELECT B_NAME, B_ADDRESS, B_TEL FROM tb_infos");
$query_infos->execute();
$infos = $query_infos->fetchAll(PDO::FETCH_ASSOC);
foreach ($infos as $info) {
    $b_name = $info['B_NAME'];
    $b_address = $info['B_ADDRESS'];
    $b_tel = $info['B_TEL'];
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('AJ-Building Administrator');
$pdf->setTitle('Prices Report');
$pdf->setSubject('TCPDF Library');
$pdf->setKeywords('TCPDF');

$PDF_HEADER_TITLE = $b_name;
$PDF_HEADER_STRING = $b_address.' - Tel.'.$b_tel;
$PDF_HEADER_LOGO = 'car.jpg';
$pdf->setHeaderData($PDF_HEADER_LOGO, 13, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 18));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 11);

// add a page
$pdf->AddPage();

$html = '
<p><b>Parking Spots Report</b></p>
<table border="1" cellpadding="4">
    <tr>
        <td style="background-color: #c0c0c0; text-align: center">Num.</td>
        <td style="background-color: #c0c0c0; text-align: center">Amount</td>
        <td style="background-color: #c0c0c0; text-align: center">Detail</td>
        <td style="background-color: #c0c0c0; text-align: center">Value</td>
        <td style="background-color: #c0c0c0; text-align: center">Currency</td>
    </tr>
';
$counter = 0;
$query_prices = $pdo->prepare("SELECT AMOUNT, DETAIL, P_VALUE, CURRENCY FROM tb_prices");
$query_prices->execute();
$prices = $query_prices->fetchAll(PDO::FETCH_ASSOC);
foreach ($prices as $price) {
    $amount = $price['AMOUNT'];
    $detail = $price['DETAIL'];
    $p_value = $price['P_VALUE'];
    $currency = $price['CURRENCY'];
    $counter = $counter + 1;
    $html .= '
    <tr>
        <td style="text-align: center">'.$counter.'</td>
        <td style="text-align: center">'.$amount.'</td>
        <td style="text-align: center">'.$detail.'</td>
        <td style="text-align: center">'.$p_value.'</td>
        <td style="text-align: center">'.$currency.'</td>
    </tr>';
}

$html .= '
</table>
';
$pdf->writeHTML($html, true, false, true, false, '');
//Close and output PDF document
$pdf->Output('PricesReport.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>