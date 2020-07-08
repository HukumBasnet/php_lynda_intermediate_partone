<?php
$sports = new ArrayIterator(array('football', 'baseball', 'cricket'));
echo '<h2>First run:</h2>';
foreach ($sports as $sport) {
    echo $sport . '<br>';
}
echo '<h2>Second run:</h2>';
foreach ($sports as $sport) {
    echo $sport . '<br>';
}