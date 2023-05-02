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
$pdf->setTitle('Roles Report');
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
<p><b>Roles List Report</b></p>
<table border="1" cellpadding="4">
    <tr>
        <td style="background-color: #c0c0c0; text-align: center; width: 80px">Num.</td>
        <td style="background-color: #c0c0c0; text-align: center">Role Name</td>
    </tr>
';
$counter = 0;
$query_roles = $pdo->prepare("SELECT NOMBRE_ROL FROM tb_roles WHERE ACTIVO = 1");
$query_roles->execute();
$roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);//ResultSet de roles - tipo Array
foreach ($roles as $role) {
    $nombre_rol = $role['NOMBRE_ROL'];
    $counter = $counter + 1;
    $html .= '
    <tr>
        <td style="text-align: center">'.$counter.'</td>
        <td>'.$nombre_rol.'</td>
    </tr>';
}

$html .= '
</table>
';
$pdf->writeHTML($html, true, false, true, false, '');
//Close and output PDF document
$pdf->Output('RolesReport.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
