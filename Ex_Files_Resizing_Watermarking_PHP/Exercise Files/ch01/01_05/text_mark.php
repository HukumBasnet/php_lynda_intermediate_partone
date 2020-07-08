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


// Create resource for text watermark


// Loop through the sizes to generate the scaled images
foreach ($sizes as $name => $size) {
    $scaled = imagescale($resource, $size);
    // Get the height of the scaled image

    // Merge text watermark into scaled image resource

    // Save the scaled image to file and remove the resource from memory
    imagejpeg($scaled, $destination . 'hoover_txt_' . $name . '.jpg', 60);
    imagedestroy($scaled);
}
// Remove the original image resource from memory
imagedestroy($resource);
echo 'Done';