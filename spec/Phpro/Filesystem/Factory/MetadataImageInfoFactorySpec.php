<?php

namespace spec\Phpro\Filesystem\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MetadataImageInfoFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Factory\MetadataImageInfoFactory');
    }
}
