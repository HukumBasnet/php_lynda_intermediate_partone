<?php
$files = new RecursiveDirectoryIterator('.', FilesystemIterator::UNIX_PATHS);
$files = new RecursiveIteratorIterator($files);
foreach ($files as $file) {
    echo $file->getPathname() . '<br>';
}