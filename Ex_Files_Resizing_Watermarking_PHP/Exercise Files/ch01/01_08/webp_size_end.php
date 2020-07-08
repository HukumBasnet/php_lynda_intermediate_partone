<?php
$image = '../../source/pelican.webp';
$size = getimagesize($image);

if ($size === false && mime_content_type($image) == 'image/webp') {
    $resource = imagecreatefromwebp($image);
    $size['w'] = imagesx($resource);
    $size['h'] = imagesy($resource);
    imagedestroy($resource);
}

print_r($size);
//var_dump($size);

//echo mime_content_type($image);