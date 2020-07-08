<?php
$files = new RecursiveDirectoryIterator('../common');
$files->setFlags(FilesystemIterator::SKIP_DOTS |
FilesystemIterator::UNIX_PATHS);
$files = new RecursiveIteratorIterator($files, RecursiveIteratorIterator::SELF_FIRST);
$files->setMaxDepth(1);
foreach ($files as $file) {
    echo $file . '<br>';
}