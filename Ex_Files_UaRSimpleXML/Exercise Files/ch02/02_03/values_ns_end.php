<?php
// load XML document
$file = '../../xml/courses_ns2.xml';
$courses = simplexml_load_file($file);

//$ns = $courses->getDocNamespaces();
$ns = $courses->getNamespaces(true);

foreach ($courses as $course) {
    echo $course->title . '<br>';
    echo $course->author . '<br>';

    $media = $course->attributes("http://search.yahoo.com/mrss/");
    echo $media['url'] . '<br>';

    $dc = $course->children($ns['dc']);
    echo $dc->description . '<br>';
    echo $dc->date . '<br>';

    $subjects = $course->subjects->children('dc', true);
    foreach ($subjects as $subject) {
        echo $subject . '<br>';
    }

    echo '<hr>';
}
