<?php
$cars = [
    ['id' => 36, 'make' => 'Ford', 'color' => 'blue'],
    ['id' => 45, 'make' => 'Chrysler', 'color' => 'green & black'],
    ['id' => 47, 'make' => 'Toyota', 'color' => 'white']
];

$xml = simplexml_load_string('<cars></cars>');

foreach ($cars as $c) {
    $car = $xml->addChild('car');
    $car->addAttribute('id', xml_amp($c['id']));
    $car->addChild('make', xml_amp($c['make']));
    $car->addChild('color', xml_amp($c['color']));
}

//$xml->asXML('cars.xml');

$doc = new DOMDocument('1.0', 'utf-8');
$doc->formatOutput = true;
$node = dom_import_simplexml($xml);
$node = $doc->importNode($node, true);
$doc->appendChild($node);
$doc->save('cars.xml');





echo 'Done';

function xml_amp($string) {
    return htmlspecialchars($string, ENT_XML1, 'UTF-8', false);
}