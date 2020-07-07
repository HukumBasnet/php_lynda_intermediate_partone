<?php
// load XML document
$file = '../../xml/courses3.xml';
$courses = simplexml_load_file($file);

foreach ($courses as $course) {
    echo $course->заглавие . '<br>';
    echo $course->{'tag-line'} . '<br>';
    echo $course->{'user.level'} . '<br>';
    echo $course->{'dc:date'} . '<br>';
    echo '<hr>';
}
