<?php

namespace spec\Phpro\Filesystem\Factory;

use Phpro\Filesystem\Process\ExifTool;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Filesystem\Filesystem;
use Zend\ServiceManager\ServiceLocatorInterface;

class MetadataExifToolFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Factory\MetadataExifToolFactory');
    }

    public function it_should_create_an_instance(ServiceLocatorInterface $serviceLocator, Filesystem $filesystem, ExifTool $process)
    {
        $serviceLocator->get('Filesystem')->willReturn($filesystem);
        $serviceLocator->get('Phpro\Filesystem\Process\ExifTool')->willReturn($process);

        $this->createService($serviceLocator)->shouldBeAnInstanceOf('Phpro\Filesystem\Metadata\Image\ExifTool');
    }
}
