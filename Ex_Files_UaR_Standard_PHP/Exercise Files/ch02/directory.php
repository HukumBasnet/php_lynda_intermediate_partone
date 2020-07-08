<?php
$dir = new DirectoryIterator('../common/images');
foreach ($dir as $key => $file) {
    //var_dump($file);
    if ($file->isFile()) {
       //echo $key . ': ' . $file->getPathname() . '<br>';
        $files[] = clone $file;
    }
}
echo $files[1]->getFilename();