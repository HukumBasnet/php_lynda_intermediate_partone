<?php
$animals = array('horse', 'aardvark', 'monkey', 'zebra',
    'giraffe', 'dog', 'cat');

$animals = SplFixedArray::fromArray($animals);
$animals->offsetUnset(2);

$animals = new SplFixedArray(10);
$animals[5] = 'dog';
$animals->offsetSet(3, 'chimpanzee');
$animals->setSize(4);
//$animals = new ArrayIterator($animals);
//$animals->asort();
//sort($animals);
echo '<pre>';
print_r($animals);
echo '</pre>';