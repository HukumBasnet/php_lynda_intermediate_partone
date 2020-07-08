<?php
$dir = new DirectoryIterator('../common/images');
foreach ($dir as $file) {
    echo $file . '<br>';
}