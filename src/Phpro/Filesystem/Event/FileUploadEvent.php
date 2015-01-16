<?php

namespace Phpro\Filesystem\Event;

use Phpro\Filesystem\File\UploadedFile;
use Zend\EventManager\Event;

/**
 * Class CreateAssetEvent
 */
class FileUploadEvent extends Event
{
    /**
     * @var UploadedFile
     */
    protected $uploadedFile;

    /**
     * @param UploadedFile $uploadedFile
     */
    public function setUploadedFile($uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }
}
