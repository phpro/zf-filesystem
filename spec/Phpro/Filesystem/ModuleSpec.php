<?php

namespace spec\Phpro\Filesystem;

use PhpSpec\ObjectBehavior;

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

    public function it_should_load_config()
    {
        $this->getConfig()->shouldBeArray();
    }

    public function it_should_load_autoloader_config()
    {
        $this->getAutoloaderConfig()->shouldBeArray();
    }
}
