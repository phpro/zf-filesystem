<?php

namespace spec\Phpro\Filesystem\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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
}
