<?php
$docs = new FilesystemIterator('../common/documents', FilesystemIterator::UNIX_PATHS);
foreach ($docs as $doc) {
    if ($doc->getExtension() == 'txt') {
        $textfile = $doc->openFile('r+');
        $textfile->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD
        | SplFileObject::DROP_NEW_LINE);
        echo '<h2>' . $textfile->getFilename() . '</h2>';
        foreach ($textfile as $line) {
            echo "$line<br>";
        }
        $textfile->seek(3);
        echo '<br>';
        echo 'This is the fourth line: ' . $textfile->current();
        while(!$textfile->eof()) {
            $textfile->next();
        }
        $textfile->fwrite("\r\n\r\nThis line was added dynamically");
    }
}
