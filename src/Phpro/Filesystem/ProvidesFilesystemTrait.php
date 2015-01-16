<?php

namespace Phpro\Filesystem;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ProvidesFilesystemTrait
 *
 * @package Phpro\Filesystem
 */
trait ProvidesFilesystemTrait
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }
}
