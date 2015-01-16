<?php

namespace Phpro\Filesystem\Facotry;

use Phpro\Filesystem\Process\ExifTool;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ExifToolProcessFactory
 *
 * @package Phpro\Filesystem\Facotry
 */
class ExifToolProcessFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('Phpro\Filesystem\Options\ExifToolOptions');

        return new ExifTool($options);
    }
}
