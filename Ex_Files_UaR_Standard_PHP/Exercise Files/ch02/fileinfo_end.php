<?php
$files = new FilesystemIterator('../common/images', FilesystemIterator::UNIX_PATHS);
foreach ($files as $file) {
    if ($file->getExtension() == 'jpg') {
        echo $file->getFilename() . ' is ' . $file->getSize() . ' bytes.' .
            ' Its absolute path is ' . $file->getRealPath()  . '<br>';
    }
}
