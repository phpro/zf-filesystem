<?php

namespace Phpro\Filesystem\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class ExifToolOptions
 *
 * @package Phpro\Filesystem\Options
 */
final class ExifToolOptions extends AbstractOptions
{

    /**
     * @var string
     */
    protected $executable;

    /**
     * @var array
     */
    protected $allowedTags = [];

    /**
     * @return array
     */
    public function getAllowedTags()
    {
        return $this->allowedTags;
    }

    /**
     * @param array $allowedTags
     */
    public function setAllowedTags($allowedTags)
    {
        $this->allowedTags = $allowedTags;
    }

    /**
     * @return string
     */
    public function getExecutable()
    {
        return $this->executable;
    }

    /**
     * @param string $executable
     */
    public function setExecutable($executable)
    {
        $this->executable = $executable;
    }

}
