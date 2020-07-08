<?php
$dirs = new RecursiveDirectoryIterator('.');
foreach ($dirs as $dir) {
    echo $dir->getFilename() . '<br>';
}