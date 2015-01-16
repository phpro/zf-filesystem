<?php

namespace Phpro\Filesystem\Metadata\Image;

use Imagick;
use Phpro\Filesystem\File\FileInterface;
use Phpro\Filesystem\Metadata\AbstractMetadata;

/**
 * Class Identify
 *
 * @package Phpro\Filesystem\Metadata\Image
 */
final class Identify extends AbstractMetadata
{

    /**
     * @var Imagick
     */
    protected $imagick;

    /**
     * @param $fileSystem
     * @param $imagick
     */
    public function __construct($fileSystem, $imagick)
    {
        $this->filesystem = $fileSystem;
        $this->imagick = $imagick;
    }

    /**
     * @param FileInterface $file
     *
     * @return array
     */
    public function getMetadataForFile(FileInterface $file)
    {
        $this->guardFileExists($file);
        return $this->parseIdentify($file);
    }

    /**
     * @param FileInterface $file
     *
     * @return array
     */
    protected function parseIdentify(FileInterface $file)
    {
        try {
            $image = $this->imagick;
            $image->readImage($file->getPath());
            $identifyData = $image->identifyImage();
            $identifyData['hasSpotColors'] = $this->parseHasSpotColors();
            $image->clear();
        } catch (\Exception $e) {
            return [];
        }

        return $identifyData;
    }

    /**
     * Check if an image has spot colors.
     *
     * @param Imagick $image
     *
     * @return bool
     */
    protected function hasSpotColors(Imagick $image)
    {
        $spotColors = $image->getImageProperties('*SpotColor*');

        return count($spotColors) ? true : false;
    }

}
