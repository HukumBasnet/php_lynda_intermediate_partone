<?php
// load XML document
$file = '../../xml/courses.xml';
$courses = simplexml_load_file($file);

echo 'Total courses: ' . $courses->count() . '<hr>';

foreach ($courses as $course) {
    echo $course->title . '<br>';
    echo $course['url'] . '<br>';
    foreach ($course->subjects->subject as $subject) {
        echo $subject . '<br>';
    }
    echo '<hr>';
}


echo $courses->course[1]->author . '<br>';
echo $courses->course[1]['url'] . '<br>';