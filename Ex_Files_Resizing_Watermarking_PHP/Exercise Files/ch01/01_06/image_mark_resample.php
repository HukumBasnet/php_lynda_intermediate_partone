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

// Set dimensions for image watermark


// Create resource for image watermark


// Merge the watermark into the main image resource


// Loop through the scaling ratios to generate resized images
foreach ($ratios as $size => $ratio) {
    // Calculate the width and height
    $w2 = $w * $ratio;
    $h2 = $h * $ratio;
    // Create an empty image resource for the smaller image
    $output = imagecreatetruecolor($w2, $h2);
    // Copy a resampled version of the original into the new image resource
    imagecopyresampled($output, $resource, 0, 0, 0, 0, $w2, $h2, $w, $h);
    // Save the resized image to file and remove the resource from memory
    imagejpeg($output, $destination . 'hoover_rs_img_' . $size . '.jpg', 100);
    imagedestroy($output);
}
// Remove the original image resource from memory
imagedestroy($resource);
imagedestroy($watermark);
echo 'Done';