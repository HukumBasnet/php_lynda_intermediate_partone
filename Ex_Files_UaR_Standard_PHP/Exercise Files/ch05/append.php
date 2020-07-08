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

$courses = simplexml_load_file('../common/data/courses.xml');
