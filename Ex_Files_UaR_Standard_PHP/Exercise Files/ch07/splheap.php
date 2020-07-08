<?php
//$data = simplexml_load_file('../common/data/courses.xml');

$data = file_get_contents('../common/data/courses.json');
$data = json_decode($data);
