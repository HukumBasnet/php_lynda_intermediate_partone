<?php
// load XML document
$file = '../../xml/courses_ns2.xml';
$courses = simplexml_load_file($file);

//$doc_ns = $courses->getDocNamespaces();
//$ns = $courses->getNamespaces(true);

$doc_ns = $courses->course[0]->subjects->getDocNamespaces();
$ns = $courses->course[0]->subjects->getNamespaces(true);

echo '<pre>';
print_r($doc_ns);
print_r($ns);
echo '</pre>';
