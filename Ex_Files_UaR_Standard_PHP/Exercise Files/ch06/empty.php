<?php
$nothing = new EmptyIterator();
foreach ($nothing as $something) {
    echo $something . '<br>';
    echo 'Is there really nothing here?';
}