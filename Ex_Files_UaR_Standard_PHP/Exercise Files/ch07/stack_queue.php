<?php
$stack = new SplStack();
$stack[] = 'A';
$stack->push('B');
$stack->push('C');
$stack[] = 'D';
$stack[] = 'E';

$queue = new SplQueue();
$queue->enqueue('A');
$queue->enqueue('B');
$queue->push('C');
$queue[] = 'D';
$queue[] = 'E';

echo '<h2>Stack</h2>';
foreach ($stack as $val) {
    echo $val . ' ';
}

echo '<h2>Queue</h2>';
foreach ($queue as $val) {
    echo $val . ' ';
}
