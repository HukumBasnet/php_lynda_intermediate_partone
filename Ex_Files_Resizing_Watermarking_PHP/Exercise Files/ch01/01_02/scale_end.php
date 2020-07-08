<?php
$original = '../../source/hoover.jpg';
$destination = '../../output/';

$sizes = [
    'small' => 300,
    'small@2' => 600,
    'large' => 450,
    'large@2' => 900
];

$resource = imagecreatefromjpeg($original);

foreach ($sizes as $name => $size) {
    $scaled = imagescale($resource, $size);
    imagejpeg($scaled, $destination . 'hoover_' . $name . '.jpg', 60);
    imagedestroy($scaled);
}
imagedestroy($resource);
echo 'Done';