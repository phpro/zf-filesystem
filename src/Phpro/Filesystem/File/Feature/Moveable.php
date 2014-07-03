<?php

namespace Phpro\Filesystem\File\Feature;

/**
 * Interface Moveable
 *
 * @package Phpro\Filesystem\File\Feature
 */
interface Moveable
{

    /**
     * Note: this method will not move the actual file.
     * It will only affect the parameters of the file object.
     *
     * @param $targetPath
     *
     * @return mixed
     */
    public function move($targetPath);

} 