<?php

namespace Phpro\Filesystem\Facotry;

use Imagick;
use Phpro\Filesystem\Metadata\Image\Identify;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MetadataIdentifyFactory
 *
 * @package Phpro\Filesystem\Facotry
 */
class MetadataIdentifyFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $filesystem = $serviceLocator->get('Filesystem');
        $imagick = new Imagick();

        return new Identify($filesystem, $imagick);
    }
}
