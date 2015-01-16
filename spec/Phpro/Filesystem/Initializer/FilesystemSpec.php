<?php

namespace spec\Phpro\Filesystem\Initializer;

use PhpSpec\ObjectBehavior;

class FilesystemSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Initializer\Filesystem');
    }

    public function it_should_implement_zend_initializerInterface()
    {
        $this->shouldImplement('Zend\ServiceManager\InitializerInterface');
    }

    /**
     * @param \Phpro\Filesystem\FilesystemAwareInterface   $instance
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @param \Symfony\Component\Filesystem\Filesystem     $filesystem
     */
    public function it_should_initialize_filesystemAwareInterfaces($instance, $serviceLocator, $filesystem)
    {
        $serviceLocator->get('Filesystem')->willReturn($filesystem);
        $this->initialize($instance, $serviceLocator);

        $instance->setFilesystem($filesystem)->shouldHaveBeenCalled();
    }
}
