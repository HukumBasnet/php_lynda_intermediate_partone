<?php
$image1 = '../../source/carpbeach.jpg';
$image2 = '../../source/lombard.jpg';

$image1 = checkJpegOrientation($image1);
$image2 = checkJpegOrientation($image2);

$dimensions1 = getimagesize($image1);
$dimensions2 = getimagesize($image2);

print_r($dimensions1);
echo '<br>';
print_r($dimensions2);

/*$exif = exif_read_data($image2);

print_r($exif);*/

function checkJpegOrientation($image) {
    $outputFile = $image;
    $exif = exif_read_data($image);
    // Calculate required angle of rotation
    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 3:
                $angle = 180;
                break;
            case 6:
                $angle = -90;
                break;
            case 8:
                $angle = 90;
                break;
            default:
                $angle = null;
        }
        // If necessary, rotate the image
        if (!is_null($angle)) {
            $original = imagecreatefromjpeg($image);
            $rotated = imagerotate($original, $angle, 0);
            // Save the rotated file with a new name
            $extension = pathinfo($image, PATHINFO_EXTENSION);
            $outputFile = str_replace(".$extension", '_rotated.jpg', $image);
            imagejpeg($rotated, $outputFile, 100);
            imagedestroy($original);
            imagedestroy($rotated);
        }
    }
    return $outputFile;
}
