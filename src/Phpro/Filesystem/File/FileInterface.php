<?php

namespace Phpro\Filesystem\File;

/**
 * Interface FileInterface
 *
 * @package Filesystem\File
 */
interface FileInterface
{
    /**
     * @return string
     */
    public function getName();
    /**
     * @return int
     */
    public function getSize();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     */
    public function getPath();
}
