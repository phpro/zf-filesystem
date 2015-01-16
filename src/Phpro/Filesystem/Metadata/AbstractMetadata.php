<?php


namespace Phpro\Filesystem\Metadata;

use Phpro\Filesystem\File\FileInterface;
use Symfony\Component\Filesystem\Filesystem;

abstract class AbstractMetadata implements MetadataProvider
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param FileInterface $file
     */
    protected function guardFileExists(FileInterface $file)
    {
        $location = $file->getPath();
        if (!$this->filesystem->exists($location)) {
            throw new \RuntimeException('File does not exist: '.$location);
        }
    }
}
