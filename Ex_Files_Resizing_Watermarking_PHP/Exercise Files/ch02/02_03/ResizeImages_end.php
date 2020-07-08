<?php
namespace Foundationphp;

class ResizeImages
{
    protected $images = [];
    protected $source;
    protected $mimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    protected $webpSupported = true;
    protected $useImageScale = true;
    protected $invalid = [];
    protected $outputSizes = [];
    protected $useLongerDimension;
    protected $jpegQuality = 75;
    protected $pngCompression = 0;
    protected $resample = IMG_BILINEAR_FIXED;
    protected $watermark;
    protected $markW;
    protected $markH;
    protected $markType;
    protected $marginR;
    protected $marginB;
    protected $destination;
    protected $generated = [];

    public function __construct(array $images, $sourceDirectory = null)
    {
        if (!is_null($sourceDirectory) && !is_dir($sourceDirectory)) {
            throw new \Exception("$sourceDirectory is not a directory.");
        }
        $this->images = $images;
        $this->source = $sourceDirectory;
        // Remove support for webp images if < PHP 5.5.0
        if (PHP_VERSION_ID < 50500) {
            array_pop($this->mimeTypes);
            $this->webpSupported = false;
        }
        // Check whether imagescale() is supported 
        if (PHP_VERSION_ID < 50519 || (PHP_VERSION_ID >= 50600 && PHP_VERSION_ID < 50603)) {
            $this->useImageScale = false;
        }
        $this->checkImages();
    }
    
    protected function checkImages()
    {
        foreach ($this->images as $i => $image) {
            $this->images[$i] = [];
            if ($this->source) {
                $this->images[$i]['file'] = $this->source . DIRECTORY_SEPARATOR . $image;
            } else {
                $this->images[$i]['file'] = $image;
            }
            if (file_exists($this->images[$i]['file']) && is_readable($this->images[$i]['file'])) {
                $size = getimagesize($this->images[$i]['file']);
                if ($size === false && $this->webpSupported && mime_content_type($this->images[$i]['file']) == 'image/webp') {
                    $this->images[$i] = $this->getWebpDetails($this->images[$i]['file']);
                } elseif ($size[0] === 0 || !in_array($size['mime'], $this->mimeTypes)) {
                    $this->invalid[] = $this->images[$i]['file'];
                } else {
                    if ($size['mime'] == 'image/jpeg') {
                        $results = $this->checkJpegOrientation($this->images[$i]['file'], $size);
                        $this->images[$i]['file'] = $results['file'];
                        $size = $results['size'];
                    }
                    $this->images[$i]['w'] = $size[0];
                    $this->images[$i]['h'] = $size[1];
                    $this->images[$i]['type'] = $size['mime'];
                }
            } else {
                $this->invalid[] = $this->images[$i]['file'];
            }
        }
    }

    protected function getWebpDetails($image)
    {
        $details = [];
        $resource = imagecreatefromwebp($image);
        $details['file'] = $image;
        $details['w'] = imagesx($resource);
        $details['h'] = imagesy($resource);
        $details['type'] = 'image/webp';
        imagedestroy($resource);
        return $details;
    }

    protected function checkJpegOrientation($image, $size)
    {
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
                // Get the dimensions and MIME type of the rotated file
                $size = getimagesize($outputFile);
                imagedestroy($original);
                imagedestroy($rotated);
            }
        }
        return ['file' => $outputFile, 'size' => $size];
    }
}