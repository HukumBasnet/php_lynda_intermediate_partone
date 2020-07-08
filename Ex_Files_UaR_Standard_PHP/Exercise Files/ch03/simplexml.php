<?php
$courses = simplexml_load_file('common/data/courses.xml', 'SimpleXMLIterator');
foreach ($courses as $course) {
    $matches = new RegexIterator($course->author, '/joh?n peck/i');
    foreach ($matches as $match) {
        echo $course->title . ' with ' . $match . ' (Duration: ' .
            $course->duration . ')<br>';
    }
}