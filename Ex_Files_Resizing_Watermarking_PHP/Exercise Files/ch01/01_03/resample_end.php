<?php
$original = '../../source/hoover.jpg';
$destination = '../../output/';

$dimensions = getimagesize($original);

//print_r($dimensions);

$w = $dimensions[0];
$h = $dimensions[1];

$ratios = [
    'small' => 300/$w,
    'small@2' => 600/$w,
    'large' => 450/$w,
    'large@2' => 900/$w
];

foreach ($ratios as $name => $ratio) {
    $w2 = $w * $ratio;
    $h2 = round($h * $ratio);
    echo "$name: $w2 x $h2 <br>";
}