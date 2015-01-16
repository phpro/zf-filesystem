<?php

namespace spec\Phpro\Filesystem\Factory;

use Phpro\Filesystem\Options\ExifToolOptions;
use PhpSpec\ObjectBehavior;
use Zend\ServiceManager\ServiceLocatorInterface;

class ExifToolProcessFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Factory\ExifToolProcessFactory');
    }

    public function it_should_create_an_instance(ServiceLocatorInterface $serviceLocator, ExifToolOptions $options)
    {
        $serviceLocator->get('Phpro\Filesystem\Options\ExifToolOptions')->willReturn($options);

        $this->createService($serviceLocator)->shouldBeAnInstanceOf('Phpro\Filesystem\Process\ExifTool');
    }
}
