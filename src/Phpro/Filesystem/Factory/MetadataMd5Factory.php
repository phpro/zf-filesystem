<?php

namespace Phpro\Filesystem\Factory;

use Phpro\Filesystem\Metadata\Md5;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MetadataMd5Factory
 *
 * @package Phpro\Filesystem\Facotry
 */
class MetadataMd5Factory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $filesystem = $serviceLocator->get('Filesystem');

        return new Md5($filesystem);
    }
}
