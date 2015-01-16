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
     * {@inheritdoc}
     *
     * @return array
     */
    public function getMetadataForFile(FileInterface $file, array $options = [])
    {
        $this->guardFileExists($file);
        $imageInfo = getimagesize($file->getPath(), $extendedInfo);

        if (isset($options['extended']) && $options['extended']) {
            $imageInfo['extended'] = $extendedInfo;
        }

        return $imageInfo;
    }

}
