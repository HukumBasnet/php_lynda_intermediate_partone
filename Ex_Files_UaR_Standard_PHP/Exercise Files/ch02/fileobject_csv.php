<?php
$csvfile = new SplFileObject('../common/data/cars_tab.csv');
$csvfile->setFlags(SplFileObject::READ_CSV);
$csvfile->setCsvControl("\t");
foreach ($csvfile as $line) {
    $cars[] = $line;
}
echo '<pre>';
print_r($cars);
echo '</pre>';