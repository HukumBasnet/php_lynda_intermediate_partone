<?php
$sports = new ArrayIterator(array('football', 'baseball', 'cricket'));
$sports = new NoRewindIterator($sports);
echo '<h2>First run:</h2>';
foreach ($sports as $sport) {
    echo $sport . '<br>';
}
$sports->rewind();
echo '<h2>Second run:</h2>';
foreach ($sports as $sport) {
    echo $sport . '<br>';
}