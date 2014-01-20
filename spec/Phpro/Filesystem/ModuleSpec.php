<?php

namespace spec\Phpro\Filesystem;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModuleSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Module');
    }

    public function it_should_implement_autoloader_provider_interface()
    {
        $this->shouldImplement('Zend\ModuleManager\Feature\AutoloaderProviderInterface');
    }

    public function it_should_implement_config_provider_interface()
    {
        $this->shouldImplement('Zend\ModuleManager\Feature\ConfigProviderInterface');
    }

    public function it_should_implement_bootstrap_listener_interface()
    {
        $this->shouldImplement('Zend\ModuleManager\Feature\BootstrapListenerInterface');
    }

    public function it_should_load_config()
    {
        $this->getConfig()->shouldBeArray();
    }

    public function it_should_load_autoloader_config()
    {
        $this->getAutoloaderConfig()->shouldBeArray();
    }

    /**
     * @param \Zend\Mvc\MvcEvent $event
     * @param \Zend\Mvc\Application $application
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function it_should_attach_filesystem_initializer($event, $application, $serviceManager)
    {
        $event->getApplication()->willReturn($application);
        $application->getServiceManager()->willReturn($serviceManager);
        $serviceManager->addInitializer('Phpro\Filesystem\Initializer\Filesystem')->shouldBeCalled();

        $this->onBootstrap($event);
    }

}
