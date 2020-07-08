<?php
$rates = array(
    array('currency' => 'Australia $', 'rate' => 0.93630),
    array('currency' => 'Canada $', 'rate' => 0.92060),
    array('currency' => 'Euro', 'rate' => 1.35630),
    array('currency' => 'Hong Kong $', 'rate' => 0.12900),
    array('currency' => 'Japan yen', 'rate' => 0.00980),
    array('currency' => 'Swiss franc', 'rate' => 1.11300),
    array('currency' => 'UK sterling', 'rate' => 1.69700)
);
if (isset($_POST['download'])) {
    $titles = array_keys($rates[0]);
    $file = new SplTempFileObject();
    $file->fputcsv($titles);
    foreach ($rates as $currency) {
        $file->fputcsv($currency);
    }
    $file->rewind();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=rates.csv');
    $file->fpassthru();
    exit;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Using SplTempFileObject</title>
    <style>
        body {
            font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;
            color: #0F0F0F;
            background-color: #FFFFFF;
            margin-left: 50px;
        }
        th {
            width: 8em;
            text-align: left;
        }
        form {
            margin-top: 1.5em;
        }
    </style>
</head>
<body>
<h1>US Dollar Exchange Rates</h1>
<table>
    <tr>
        <th>Currency</th>
        <th>Rate ($1)</th>
    </tr>
    <?php
    foreach ($rates as $row) { ?>
        <tr>
            <td>
                <?= $row['currency']; ?>
            </td>
            <td>
                <?= number_format($row['rate'], 5); ?>
            </td>
        </tr>
    <?php } ?>
</table>
<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="download" value="Download rates">
</form>
</body>
</html>
