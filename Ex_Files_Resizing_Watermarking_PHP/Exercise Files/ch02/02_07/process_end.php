<?php
require_once './ResizeImages.php';

use Foundationphp\ResizeImages;

$images = new FilesystemIterator('../../source');
$images = new RegexIterator($images, '/(?<!watermark|_rotated)\.(jpg|png|gif|webp)$/');
$originals = [];
foreach ($images as $image) {
    $originals[] = $image->getFilename();
}

//print_r($originals);

try {
    $resize = new ResizeImages($originals, '../../source');
    $resize->setOutputSizes([400, 500, 600, 750], false);
    $resize->watermark('../../source/watermark.webp');
    $result = $resize->outputImages('../../output3');
    if ($result['output']) {
        echo 'The following images were generated:<br>';
        echo '<ul>';
        foreach ($result['output'] as $output) {
            echo "<li>$output</li>";
        }
        echo '</ul>';
    }
    if ($result['invalid']) {
        echo 'The following files were invalid:<br>';
        echo '<ul>';
        foreach ($result['invalid'] as $invalid) {
            echo "<li>$invalid</li>";
        }
        echo '</ul>';
    }
} catch (Exception $e) {
    echo $e->getMessage();
}