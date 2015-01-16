<?php

namespace spec\Phpro\Filesystem\Options;

use PhpSpec\ObjectBehavior;

class ExifToolOptionsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Options\ExifToolOptions');
    }

    public function it_should_be_options()
    {
        $this->shouldHaveType('Zend\Stdlib\AbstractOptions');
    }

    public function it_should_know_the_executable()
    {
        $this->setExecutable('exe');
        $this->getExecutable()->shouldReturn('exe');
    }

    public function it_should_know_the_allowed_tags()
    {
        $this->setAllowedTags(['tag1']);
        $this->getAllowedTags()->shouldReturn(['tag1']);
    }
}
