<?php

namespace Phpro\Filesystem\File;

/**
 * Class LocalFile
 *
 * @package Phpro\Filesystem\File
 */
class LocalFile implements FileInterface
{

    /**
     * @var string
     */
    protected $file;

    /**
     * @var int
     */
    protected $size = 0;

    /**
     * @var string
     */
    protected $mime = null;

    /**
     * @param $file
     * @throws \RuntimeException
     */
    public function __construct($file)
    {
        if (!file_exists($file)) {
            throw new \RuntimeException(sprintf('Invalid file: %s', $file));
        }

        $this->file = realpath($file);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return pathinfo($this->file, PATHINFO_BASENAME);
    }

    /**
     * @return int
     */
    public function getSize()
    {
        if (!$this->size) {
            $this->size = filesize($this->file);
        }
        return $this->size;
    }

    /**
     * @return string
     */
    public function getType()
    {
        if (!$this->mime) {
            $finfo = new \finfo(FILEINFO_MIME);
            $this->mime = $finfo->file($this->file);
        }
        return $this->mime;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->file;
    }

}
