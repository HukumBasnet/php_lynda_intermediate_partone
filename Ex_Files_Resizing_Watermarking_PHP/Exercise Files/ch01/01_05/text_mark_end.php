<?php
$original = '../../source/hoover.jpg';
$destination = '../../output/';

// Widths of resized images
$sizes = [
    'small' => 300,
    'small@2' => 600,
    'large' => 450,
    'large@2' => 900
];

// Image resource for original image
$resource = imagecreatefromjpeg($original);

// Set dimensions for text watermark
$markW = 170;
$markH = 25;
$margin_bottom = $margin_right = 10;

// Create resource for text watermark
$watermark = imagecreatetruecolor($markW, $markH);
imagefilledrectangle($watermark, 0, 0, $markW, $markH, 0x000000);
imagestring($watermark, 5, 10, 5, '(c) David Powers', 0xFFFFFF);

// Loop through the sizes to generate the scaled images
foreach ($sizes as $name => $size) {
    $scaled = imagescale($resource, $size);
    // Get the height of the scaled image
    $h2 = imagesy($scaled);
    // Merge text watermark into scaled image resource
    imagecopymerge($scaled, $watermark, $size - $markW - $margin_right, $h2 - $markH - $margin_bottom, 0, 0, $markW, $markH, 50);
    // Save the scaled image to file and remove the resource from memory
    imagejpeg($scaled, $destination . 'hoover_txt_' . $name . '.jpg', 60);
    imagedestroy($scaled);
}
// Remove the original image resource from memory
imagedestroy($resource);
imagedestroy($watermark);
echo 'Done';