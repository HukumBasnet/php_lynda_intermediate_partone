<?php
$files = new RecursiveDirectoryIterator('../common');
$files->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
