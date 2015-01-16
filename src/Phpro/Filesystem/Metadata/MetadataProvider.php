<?php

namespace Phpro\Filesystem\Metadata;

use Phpro\Filesystem\File\FileInterface;

/**
 * Interface MetadataProvider
 *
 * @package Phpro\Filesystem\Metadata
 */
interface MetadataProvider
{
    /**
     * @param FileInterface $file
     * @param array         $options
     *
     * @return mixed
     */
    public function getMetadataForFile(FileInterface $file, array $options = []);
}
