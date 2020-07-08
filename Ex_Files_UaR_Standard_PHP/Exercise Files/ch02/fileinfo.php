<?php
$files = new FilesystemIterator('../common/images', FilesystemIterator::UNIX_PATHS);
foreach ($files as $file) {
    echo $file . '<br>';
}