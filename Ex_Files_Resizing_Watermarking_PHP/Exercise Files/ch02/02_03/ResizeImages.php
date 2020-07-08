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
        
    }
}