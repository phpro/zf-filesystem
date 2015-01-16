<?php

namespace spec\Phpro\Filesystem\Factory;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Filesystem\Filesystem;
use Zend\ServiceManager\ServiceLocatorInterface;

class MetadataMd5FactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Factory\MetadataMd5Factory');
    }

    public function it_should_create_an_instance(ServiceLocatorInterface $serviceLocator, Filesystem $filesystem)
    {
        $serviceLocator->get('Filesystem')->willReturn($filesystem);

        $this->createService($serviceLocator)->shouldBeAnInstanceOf('Phpro\Filesystem\Metadata\Md5');
    }
}
