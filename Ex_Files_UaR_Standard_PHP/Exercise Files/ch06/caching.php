<?php
$courses = simplexml_load_file('../common/data/courses.xml', 'SimpleXMLIterator');
foreach ($courses as $course) {
    echo "<h2>$course->title</h2>";
    echo "<p>$course->description</p>";
}