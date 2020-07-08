<?php
$files = new RecursiveDirectoryIterator('.');
$files->setFlags(FilesystemIterator::UNIX_PATHS);
