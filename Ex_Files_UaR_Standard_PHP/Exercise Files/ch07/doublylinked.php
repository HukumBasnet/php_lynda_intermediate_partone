<?php
$courses = simplexml_load_file('../common/data/courses.xml');
foreach ($courses as $course) {
    echo $course->author . ': ' . $course->title . ' (duration: ' . $course->duration . ')<br>';
}