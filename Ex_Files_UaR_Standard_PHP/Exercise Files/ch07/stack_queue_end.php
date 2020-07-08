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
echo '<br><br>';

echo 'This was popped from the stack: ' . $stack->pop() . '<br>';
echo 'This was dequeued from the queue: ' . $queue->dequeue() . '<br>';

$stack->setIteratorMode(SplStack::IT_MODE_DELETE | SplStack::IT_MODE_LIFO);
$queue->setIteratorMode(SplQueue::IT_MODE_DELETE | SplQueue::IT_MODE_FIFO);

echo '<h2>Stack</h2>';
foreach ($stack as $val) {
    echo $val . ' ';
}

echo '<h2>Queue</h2>';
foreach ($queue as $val) {
    echo $val . ' ';
}
echo '<br><br>';
if ($stack->isEmpty() && $queue->isEmpty()) {
    echo 'Both stack and queue are now empty';
}