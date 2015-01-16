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
final class ExifTool extends AbstractMetadata
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
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @param FileInterface $file
     *
     * @return mixed
     */
    public function getMetadataForFile(FileInterface $file)
    {
        $this->guardFileExists($file);
        return $this->exifToolProcess->scanFile($file, $this->tag);
    }

}
