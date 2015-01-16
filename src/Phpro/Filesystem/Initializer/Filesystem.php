<?php

namespace Phpro\Filesystem\Initializer;

use Phpro\Filesystem\FilesystemAwareInterface;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Filesystem
 *
 * @package Filesystem\Initializer
 */
class Filesystem
    implements InitializerInterface
{
    /**
     * Initialize
     *
     * @param                         $instance
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if (!($instance instanceof FilesystemAwareInterface)) {
            return;
        }

        $fileSystem = $serviceLocator->get('Filesystem');
        $instance->setFilesystem($fileSystem);
    }
}
