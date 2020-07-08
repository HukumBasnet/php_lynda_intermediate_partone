<?php
class AuthorFilter extends FilterIterator
{
    protected $author;

    public function __construct(Iterator $iterator, $author)
    {
        parent::__construct($iterator);
        $this->author = $author;
    }

    public function accept()
    {
        return $this->current()->author == $this->author;
    }
}


$courses = simplexml_load_file('../common/data/courses.xml', 'SimpleXMLIterator');
$courses = new AuthorFilter($courses, 'Kevin Skoglund');
foreach ($courses as $course) {
    echo "$course->title with $course->author (duration: $course->duration)<br>";
}