<?php
$image = '../../source/pelican.webp';

$resource = imagecreatefromwebp($image);
imagejpeg($resource, '../../output/pelican2.jpg');
imagedestroy($resource);
echo 'Done';