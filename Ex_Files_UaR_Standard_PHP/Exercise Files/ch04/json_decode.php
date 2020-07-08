<?php
$courses = file_get_contents('common/data/courses.json');
$courses = json_decode($courses);
print_r($courses);