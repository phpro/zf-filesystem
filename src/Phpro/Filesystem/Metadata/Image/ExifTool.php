<?php

namespace Phpro\Filesystem\Metadata\Image;

use Phpro\Filesystem\File\FileInterface;
use Phpro\Filesystem\Metadata\AbstractMetadata;
use Phpro\Filesystem\Process\ExifTool as ExifToolProcess;

/**
 * Class ExifTool
 *
 * @package Phpro\Filesystem\Metadata\Image
 */
class ExifTool extends AbstractMetadata
{
    /**
     * @var ExifToolProcess
     */
    protected $exifToolProcess;

    /**
     * @var $tag
     */
    protected $tag = null;

    /**
     * @param $fileSystem
     * @param $exifToolProcess
     */
    public function __construct($fileSystem, $exifToolProcess)
    {
        $this->filesystem = $fileSystem;
        $this->exifToolProcess = $exifToolProcess;
    }

    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function getMetadataForFile(FileInterface $file, array $options = [])
    {
        $this->guardFileExists($file);

        $tag = isset($options['tag']) ? $options['tag'] : null;

        return $this->exifToolProcess->scanFile($file, $tag);
    }
}
