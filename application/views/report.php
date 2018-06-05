<?php
tcpdf();
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Report');
$pdf->SetAuthor('Power Grid');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 9);
$pdf->setFontSubsetting(false);
$pdf->AddPage();
ob_start();
?>
<html>
<body>
<div style="text-align: center;">
    <h1>Power Grid Report</h1>
    <h2><?php echo $date; ?></h2>
</div>
<table>
    <tr><td>Total Usage:</td><td><?php echo $usage; ?> kW</td></tr>
    <tr><td>Total Production:</td><td><?php echo $production; ?> kW</td></tr>
</table>
</body>
</html>
<?php
$content = ob_get_contents();
ob_end_clean();
$pdf->writeHTML($content, true, false, true, false, '');
$pdf->Output('PowerGridReport'.'.pdf', 'D');
?>