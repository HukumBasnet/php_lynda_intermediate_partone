<?php
// Multidimensional associative array
$array = array('Cameras' => array('DSLR', 'smartphone', 'compact'),
               'Lenses' => array('telephoto', 'wide angle', 'fisheye'),
               'Accessories' => array('tripod', 'camera bag', 'Filters' =>
                                                                  array('polarizing', 'UV', 'neutral density')));

// Convert the array to a recursive iterator
$array = new RecursiveArrayIterator($array);

// Use ParentIterator to select elements that have children
$categories = new ParentIterator($array);

// Iterate recursively over the filtered array
// Set the mode to SELF_FIRST to get both key and value, but ignore the value
$categories = new RecursiveIteratorIterator($categories, RecursiveIteratorIterator::SELF_FIRST);
foreach ($categories as $category => $value) {
    echo $category . '<br>';
}