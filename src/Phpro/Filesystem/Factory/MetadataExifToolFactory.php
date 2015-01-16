<?php

namespace Phpro\Filesystem\Facotry;

use Phpro\Filesystem\Metadata\Image\ExifTool;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MetadataExifToolFactory
 *
 * @package Phpro\Filesystem\Facotry
 */
class MetadataExifToolFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $filesystem = $serviceLocator->get('Filesystem');
        $exifToolProcess = $serviceLocator->get('Phpro\Filesystem\Process\ExifTool');

        return new ExifTool($filesystem, $exifToolProcess);
    }
}
