<?php
$image1 = '../../source/carpbeach.jpg';
$image2 = '../../source/lombard.jpg';

$dimensions1 = getimagesize($image1);
$dimensions2 = getimagesize($image2);

print_r($dimensions1);
echo '<br>';
print_r($dimensions2);
