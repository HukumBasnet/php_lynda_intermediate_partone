<?php
$boys = new ArrayIterator(array('Ian', 'Mark', 'David'));
$girls = new ArrayIterator(array('Jennifer', 'Alice', 'Susan'));
$unisex = new ArrayIterator(array('Jody', 'Alex'));

$append = new AppendIterator();
$append->append($boys);
$append->append($girls);
$append->append($unisex);

echo '<h2>AppendIterator: </h2>';
foreach ($append as $name) {
    echo $name . '<br>';
}

$multiple = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
$multiple->attachIterator($boys, 'boys');
$multiple->attachIterator($girls, 'girls');
$multiple->attachIterator($unisex, 'unisex');

echo '<h2>MultipleIterator: </h2>';
echo '<pre>';
foreach ($multiple as $names) {
    print_r($names);
}
echo '</pre>';