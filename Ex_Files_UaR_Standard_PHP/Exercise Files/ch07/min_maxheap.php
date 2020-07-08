<?php
$animals = array('horse', 'aardvark', 'monkey', 'zebra',
    'giraffe', 'dog', 'cat');

$min = new SplMinHeap();
foreach ($animals as $animal) {
    $min->insert($animal);
}

$max = new SplMaxHeap();
foreach ($animals as $animal) {
    $max->insert($animal);
}
echo '<pre>';
print_r($min);
print_r($max);
echo '</pre>';