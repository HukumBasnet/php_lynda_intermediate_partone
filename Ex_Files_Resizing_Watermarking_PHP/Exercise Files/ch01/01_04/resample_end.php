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

$resource = imagecreatefromjpeg($original);

foreach ($ratios as $name => $ratio) {
    $w2 = $w * $ratio;
    $h2 = round($h * $ratio);
    //echo "$name: $w2 x $h2 <br>";
    $output = imagecreatetruecolor($w2, $h2);
    imagecopyresampled($output, $resource, 0, 0, 0, 0, $w2, $h2, $w, $h);
    imagejpeg($output, $destination . 'hoover_rs_' . $name . '.jpg', 100);
    imagedestroy($output);
}
imagedestroy($resource);
echo 'Done';