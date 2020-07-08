<?php
require_once './ResizeImages.php';

use Foundationphp\ResizeImages;

$images = new FilesystemIterator('../../source');
$images = new RegexIterator($images, '/(?<!watermark|_rotated)\.(jpg|png|gif|webp)$/');
$originals = [];
foreach ($images as $image) {
    $originals[] = $image->getFilename();
}

print_r($originals);
