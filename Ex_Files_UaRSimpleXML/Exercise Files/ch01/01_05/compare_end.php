<?php
// load XML document
$file = '../../xml/courses2.xml';
$courses = simplexml_load_file($file);

foreach ($courses as $course) {
    if ($course->author != 'Jon Peck') {
        echo $course->title . '<br>';
        echo strtoupper($course->author) . '<br>';
        echo $course['url'] . '<br>';
        echo '<hr>';
    }
}
