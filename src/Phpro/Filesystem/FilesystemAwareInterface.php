<?php

namespace Phpro\Filesystem;

/**
 * Interface FilesystemAwareInterface
 *
 * @package Filesystem
 */
interface FilesystemAwareInterface
{
    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     */
    public function setFilesystem($filesystem);

    /**
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    public function getFilesystem();
}
