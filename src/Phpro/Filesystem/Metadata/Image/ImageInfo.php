<?php

namespace Phpro\Filesystem\Metadata\Image;

use Phpro\Filesystem\File\FileInterface;
use Phpro\Filesystem\Metadata\AbstractMetadata;

/**
 * Class ImageInfo
 *
 * @package Phpro\Filesystem\Metadata\Image
 */
final class ImageInfo extends AbstractMetadata
{

    /**
     * @param $fileSystem
     */
    public function __construct($fileSystem)
    {
        $this->filesystem = $fileSystem;
    }

    /**
     * @param FileInterface $file
     *
     * @return mixed
     */
    public function getMetadataForFile(FileInterface $file)
    {
        $this->guardFileExists($file);
        $imageInfo = getimagesize($file->getPath(), $extendedInfo);
        $imageInfo['extended'] = $extendedInfo;

        return $imageInfo;
    }

}
