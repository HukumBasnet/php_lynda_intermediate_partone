<?php
class AuthorFilter extends FilterIterator
{
    protected $author;

    public function __construct($iterator, $author)
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
$powers = new AuthorFilter($courses, 'David Powers');
$peck = new AuthorFilter($courses, 'Jon Peck');
$courses = new AppendIterator();
$courses->append($peck);
$courses->append($powers);
$previous = '';
foreach ($courses as $course) {
    if ($previous != $course->author) {
        echo "<h2>Courses by $course->author</h2>";
    }
    echo $course->title . '<br>';
    $previous = (string) $course->author;
}