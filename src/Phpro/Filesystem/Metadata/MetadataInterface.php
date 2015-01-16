<?php

namespace Phpro\Filesystem\Metadata;

use Phpro\Filesystem\File\FileInterface;

/**
 * Interface MetadataInterface
 *
 * @package Phpro\Filesystem\Metadata
 */
interface MetadataInterface
{

    /**
     * @param FileInterface $file
     * @param array $options
     *
     * @return mixed
     */
    public function getMetadataForFile(FileInterface $file, array $options = []);

}
