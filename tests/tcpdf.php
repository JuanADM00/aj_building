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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79,80), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 002');
$pdf->setSubject('TCPDF Tutorial');
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
        <div style="text-align: left">
            -----------------------------------------------------------------------------------<br>
            <b>CLIENT DATA</b><br>
            <b>MR/MS: </b>ANDREW CUNANAN<br>
            <b>TIN: </b>123456789<br>
            -----------------------------------------------------------------------------------<br>
            <b>ENTRY DATE: </b>26/09/2022<br>
            <b>ENTRY TIME: </b>18:00<br>
            <b>SPOT NUMBER: </b>35<br>
            -----------------------------------------------------------------------------------<br>
            <b>USER: </b>JUAN AMAYA DUARTE
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
