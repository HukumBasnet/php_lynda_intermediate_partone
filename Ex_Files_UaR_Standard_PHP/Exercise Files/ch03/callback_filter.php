<?php
$courses = simplexml_load_file('../common/data/courses.xml');
foreach ($courses as $course) {
    echo "$course->title with $course->author (level: $course->level)<br>";
}