<?php

namespace Phpro\Filesystem\Metadata;
use Phpro\Filesystem\File\FileInterface;

/**
 * Class Md5
 *
 * @package Phpro\Filesystem\Metadata
 */
final class Md5 extends AbstractMetadata
{

    /**
     * @param $fileSystem
     */
    public  function __construct($fileSystem)
    {
        $this->filesystem = $fileSystem;
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function getMetadataForFile(FileInterface $file, array $options = [])
    {
        $this->guardFileExists($file);
        $md5 = md5_file($file->getPath());
        return $md5;
    }

}
