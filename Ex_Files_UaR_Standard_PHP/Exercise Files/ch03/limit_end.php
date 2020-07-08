<?php
$courses = simplexml_load_file('common/data/courses.xml', 'SimpleXMLIterator');
$courses = new LimitIterator($courses, 20, 10);
foreach ($courses as $course) {
    echo $courses->getPosition() + 1 . ". $course->title with $course->author
    (duration:
    $course->duration)
    <br>";
}