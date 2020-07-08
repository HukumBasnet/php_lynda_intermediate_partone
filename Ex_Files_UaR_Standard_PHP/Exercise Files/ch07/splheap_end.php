<?php
class SortCourses extends SplHeap
{
    protected function compare($val1, $val2)
    {
        $val1 = (string) $val1->title;
        $val2 = (string) $val2->title;
        if ($val1 == $val2) {
            return 0;
        } elseif ($val1 > $val2) {
            return -1;
        } else {
            return 1;
        }
    }
}

//$data = simplexml_load_file('common/data/courses.xml');

$data = file_get_contents('common/data/courses.json');
$data = json_decode($data);

$courses = new SortCourses();
foreach ($data as $item) {
    $courses->insert($item);
}
foreach ($courses as $course) {
    echo "<h2>$course->title with $course->author</h2>";
    echo "<p>$course->description</p>";
}