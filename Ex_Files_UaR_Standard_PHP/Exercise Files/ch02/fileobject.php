<?php
$docs = new FilesystemIterator('../common/documents', FilesystemIterator::UNIX_PATHS);
foreach ($docs as $doc) {
    if ($doc->getExtension() == 'txt') {
        echo $doc . '<br>';
    }
}
