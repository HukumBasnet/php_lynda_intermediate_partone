<?php
$file = '../../xml/courses.xml';

// load from file or URL
$courses = simplexml_load_file($file);

// load from string
$string = <<< END
<cars>
    <car>
        <make>Ford</make>
        <color>black</color>
    </car>
    <car>
        <make>Toyota</make>
        <color>white</color>
    </car>
</cars>
END;
$cars = simplexml_load_string($string);

// use SimpleXMLElement constructor
$cars2 = new SimpleXMLElement($string);
$courses2 = new SimpleXMLElement($file, null, true);

echo '<pre>';
//print_r($courses);
//print_r($cars);
//print_r($cars2);
print_r($courses2);
echo '</pre>';