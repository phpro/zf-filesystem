<?php

namespace Phpro\Filesystem\Facotry;

use Phpro\Filesystem\Options\ExifToolOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ExifToolOptionsFactory
 *
 * @package Phpro\Filesystem\Facotry
 */
class ExifToolOptionsFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $options = $config['phpro_filesystem']['exiftool'];

        return new ExifToolOptions($options);
    }
}
