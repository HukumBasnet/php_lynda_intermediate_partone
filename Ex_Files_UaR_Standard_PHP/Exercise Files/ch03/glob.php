<?php
$files = new GlobIterator(__DIR__ . '/common/images/*.jpg');
foreach ($files as $file) {
    echo $file->getFilename() . '<br>';
}