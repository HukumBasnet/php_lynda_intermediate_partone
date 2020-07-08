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

// Get width and height of original image resource


// Set dimensions for image watermark


// Create resource for image watermark


// Merge the watermark into the main image resource


// Loop through the sizes to generate the scaled images
foreach ($sizes as $name => $size) {
    $scaled = imagescale($resource, $size);
    // Save the scaled image to file and remove the resource from memory
    imagejpeg($scaled, $destination . 'hoover_img_' . $name . '.jpg', 60);
    imagedestroy($scaled);
}
// Remove the original image resource from memory
imagedestroy($resource);
echo 'Done';