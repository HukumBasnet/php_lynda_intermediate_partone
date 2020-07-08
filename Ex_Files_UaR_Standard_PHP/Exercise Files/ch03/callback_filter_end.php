<?php
$courses = simplexml_load_file('common/data/courses.xml', 'SimpleXMLIterator');
$courses = new CallbackFilterIterator($courses, 'getBeginner');
foreach ($courses as $course) {
    echo "$course->title with $course->author (level: $course->level)<br>";
}
function getBeginner($current) {
    return strtolower($current->level) == 'beginner';
}