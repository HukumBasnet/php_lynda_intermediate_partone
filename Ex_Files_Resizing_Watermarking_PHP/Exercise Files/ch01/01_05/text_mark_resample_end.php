<?php
$original = '../../source/hoover.jpg';
$destination = '../../output/';
$dimensions = getimagesize($original);

// Width and height of original image
$w = $dimensions[0];
$h = $dimensions[1];

// Resizing ratios for smaller images
$ratios = [
    'small' => 300/$w,
    'small@2' => 600/$w,
    'large' => 450/$w,
    'large@2' => 900/$w
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

// Loop through the scaling ratios to generate resized images
foreach ($ratios as $size => $ratio) {
    // Calculate the width and height
    $w2 = $w * $ratio;
    $h2 = $h * $ratio;
    // Create an empty image resource for the smaller image
    $output = imagecreatetruecolor($w2, $h2);
    // Copy a resampled version of the original into the new image resource
    imagecopyresampled($output, $resource, 0, 0, 0, 0, $w2, $h2, $w, $h);
    // Merge text watermark into resized image resource
    imagecopymerge($output, $watermark, $w2 - $markW - $margin_right, $h2 - $markH - $margin_bottom, 0, 0, $markW, $markH, 50);
    // Save the resized image to file and remove the resource from memory
    imagejpeg($output, $destination . 'hoover_rs_txt_' . $size . '.jpg', 100);
    imagedestroy($output);
}
// Remove the original image resource from memory
imagedestroy($resource);
imagedestroy($watermark);
echo 'Done';