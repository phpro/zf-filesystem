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
     *
     * @return mixed
     */
    public function getMetadataForFile(FileInterface $file);

}
