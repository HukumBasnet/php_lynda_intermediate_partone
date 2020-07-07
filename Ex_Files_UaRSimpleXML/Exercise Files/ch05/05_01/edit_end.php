<?php
// load XML document
$file = '../../xml/courses.xml';
$courses = simplexml_load_file($file);

foreach ($courses as $course) {
//    $course['url'] = str_replace('.html', '.php', $course['url']);
    $course->level = 'Advanced';
    unset($course->subjects);
    unset($course['url']);
}
//header('Content-type: text/xml');
//echo $courses->asXML();
$courses->asXML('courses.xml');
echo 'Done';