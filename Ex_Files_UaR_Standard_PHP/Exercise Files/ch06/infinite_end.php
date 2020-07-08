<?php
$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$days = new ArrayIterator($days);
$days = new InfiniteIterator($days);
$days = new LimitIterator($days, 3, 7);
foreach ($days as $day) {
    echo $day . '<br>';
}