<?php
function randomSwatch() {
    // Start output buffer
    ob_start();

    // Create an image resource
    $img = imagecreatetruecolor(150, 100);

    // Generate random color values
    $r = mt_rand(0, 255);
    $g = mt_rand(0, 255);
    $b = mt_rand(0, 255);

    // Fill the image resource with the color and export to PNG
    $fill = imagecolorallocate($img, $r, $g, $b);
    imagefill($img, 0, 0, $fill);
    imagepng($img);

    // Get the image data from the output buffer
    $image_data = ob_get_contents();

    // Clean the buffer and destroy the image resource
    ob_end_clean();
    imagedestroy($img);

    return $image_data;
}