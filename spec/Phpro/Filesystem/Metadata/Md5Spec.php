<?php

namespace spec\Phpro\Filesystem\Metadata;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Md5Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Metadata\Md5');
    }
}
