<?php
tcpdf();
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Power Grid Report');
$pdf->SetAuthor('Power Grid');
$pdf->setSubject('Power Grid Report');
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
<head>
    <style>
        .center {
            text-align: center;
        }
        table, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
            border: 1px solid black;
            background-color: #9b9b9b;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="center">
    <h1>Power Grid Report</h1>
    <h2><?php echo $date; ?></h2>
</div>
<table>
    <thead>
    <tr>
        <th></th>
        <th>Peak</th>
        <th>Shoulder</th>
        <th>Off Peak</th>
        <th>Unit</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Price</td>
        <td><?php echo $price['peak']; ?></td>
        <td><?php echo $price['shoulder']; ?></td>
        <td><?php echo $price['offpeak']; ?></td>
        <td>cents per kWh</td>
    </tr>
    </tbody>
</table>
<br><br>
<table>
    <thead>
    <tr>
        <th>Dates</th>
        <th>Total Usage</th>
        <th>Total Production</th>
        <th>Buy/Sell</th>
        <th>Spend/Earn</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $usage = $production = $sum = $final = 0;
    foreach($reports as $report) {
        echo "<tr><td>{$report['date']}</td>";
        echo "<td>{$report['usage']} kW</td>";
        echo "<td>{$report['production']} kW</td>";
        echo "<td>{$report['sum']} kW</td>";
        echo "<td>{$report['final']} AUD</td></tr>";

        $usage += $report['usage'];
        $production += $report['production'];
        $sum += $report['sum'];
        $final += $report['final'];
    }
    if(count($reports) > 1) {
        echo "<tr><td>Total</td><td>$usage kW</td><td>$production kW</td><td>$sum kW</td><td>$final AUD</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
<?php
$content = ob_get_contents();
ob_end_clean();
$pdf->writeHTML($content, true, false, true, false, '');
$pdf->Output('PowerGridReport'.'.pdf', 'D');
?>