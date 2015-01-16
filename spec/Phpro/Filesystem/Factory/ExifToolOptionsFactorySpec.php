<?php

namespace spec\Phpro\Filesystem\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\ServiceManager\ServiceLocatorInterface;

class ExifToolOptionsFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Factory\ExifToolOptionsFactory');
    }

    public function it_is_a_facotry()
    {
        $this->shouldImplement('Zend\ServiceManager\FactoryInterface');
    }

    public function it_should_create_an_instance(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator->get('config')->willReturn([
            'phpro_filesystem' => [
                'exiftool' => [
                    'executable' => '/usr/bin/exiftool',
                    'allowed_tags' => ['tags']
                ],
            ],
        ]);

        $this->createService($serviceLocator)->shouldBeAnInstanceOf('Phpro\Filesystem\Options\ExifToolOptions');
    }
}
