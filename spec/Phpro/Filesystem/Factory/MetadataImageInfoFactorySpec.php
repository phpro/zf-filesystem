<?php

namespace spec\Phpro\Filesystem\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;
use Zend\ServiceManager\ServiceLocatorInterface;

class MetadataImageInfoFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Factory\MetadataImageInfoFactory');
    }

    public function it_should_create_an_instance(ServiceLocatorInterface $serviceLocator, Filesystem $filesystem)
    {
        $serviceLocator->get('Filesystem')->willReturn($filesystem);

        $this->createService($serviceLocator)->shouldBeAnInstanceOf('Phpro\Filesystem\Metadata\Image\ImageInfo');
    }
}
