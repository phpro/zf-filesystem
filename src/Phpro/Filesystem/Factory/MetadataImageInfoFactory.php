<?php

namespace Phpro\Filesystem\Factory;

use Phpro\Filesystem\Metadata\Image\ImageInfo;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MetadataImageInfoFactory
 *
 * @package Phpro\Filesystem\Facotry
 */
class MetadataImageInfoFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $filesystem = $serviceLocator->get('Filesystem');

        return new ImageInfo($filesystem);
    }
}
