<?php
// data to be converted to XML
$courses = [
    [   'url' => 'http://www.lynda.com/Symfony-tutorials/Up-Running-Symfony2-PHP/160060-2.html',
        'title' => 'Up & Running with Symfony2 for PHP',
        'author' => 'Jon Peck',
        'date' => '2014-08-21'
            ],
    [
        'url' => 'http://www.lynda.com/PHP-tutorials/Creating-Secure-PHP-Websites/133321-2.html',
        'title' => 'Creating Secure PHP Websites',
        'author' => 'Kevin Skoglund',
        'date' => '2014-06-30'
    ]
];

// create the root element
$xml = simplexml_load_string('<courses></courses>');

// loop through the data and add it to the XML root
foreach ($courses as $c) {
    $course = $xml->addChild('ns1:course', null, 'http://www.example.com/ns1');
    $course->addAttribute('media:url', xml_amp($c['url']), 'http://search.yahoo.com/mrss/');
    $course->addChild('title', xml_amp($c['title']), null);
    $course->addChild('author', xml_amp($c['author']), null);
    $course->addChild('dc:date', xml_amp($c['date']), 'http://purl.org/dc/elements/1.1/');
}

// encode ampersands in text content
function xml_amp($string) {
    return htmlspecialchars($string, ENT_XML1, 'UTF-8', false);
}

// format the output
$doc = new DOMDocument('1.0', 'utf-8');
$doc->formatOutput = true;
$node = dom_import_simplexml($xml);
$node = $doc->importNode($node, true);
$doc->appendChild($node);
$doc->save('courses.xml');
echo 'Done';