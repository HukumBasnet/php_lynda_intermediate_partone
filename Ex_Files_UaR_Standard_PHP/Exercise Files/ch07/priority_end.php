<?php
// Set priority of entry in PHP error log
function setPriority($line) {
    // Find the first instance of PHP in the line
    $start = strpos($line, 'PHP');
    // Find the first colon after PHP
    $end = strpos($line, ':', $start);
    // Extract the error level
    $error = substr($line, $start, $end-$start);
    // Return priority according to error level
    switch ($error) {
        case 'PHP Fatal error':
        case 'PHP Catchable fatal error':
            return 10;
        case 'PHP Warning':
            return 8;
        case 'PHP Deprecated':
            return 7;
        case 'PHP Parse error':
            return 5;
        case 'PHP Notice':
            return 2;
        default:
            return 0;
    }
}

$log = new SplPriorityQueue();
$file = new SplFileObject('C:\xampp\php\logs\php_error_log');
while (!$file->eof()) {
    $line = $file->fgets();
    $log->insert($line, setPriority($line));
}
while (!$log->isEmpty()) {
    echo $log->extract() . '<br>';
}