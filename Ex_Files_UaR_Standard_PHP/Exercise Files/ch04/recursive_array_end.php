<?php
$products = array(
    'Cameras'     => array('DSLR', 'smartphone', 'compact'),
    'Lenses'      => array('telephoto', 'wide angle', 'fisheye'),
    'Accessories' => array('tripod', 'camera bag', 'Filters' =>
        array('polarizing', 'UV', 'neutral density')));
$products = new RecursiveArrayIterator($products);
$products = new RecursiveIteratorIterator($products, RecursiveIteratorIterator::SELF_FIRST);
foreach ($products as $category => $item) {
    $level = $products->getDepth() + 2;
    if ($products->hasChildren()) {
        echo "<h$level>$category</h$level>";
    } else {
        echo $item . '<br>';
    }
}