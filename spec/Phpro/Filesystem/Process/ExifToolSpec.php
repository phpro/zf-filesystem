<?php

namespace spec\Phpro\Filesystem\Process;

use Phpro\Filesystem\Options\ExifToolOptions;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExifToolSpec extends ObjectBehavior
{

    public function let(ExifToolOptions $options)
    {
        $this->beConstructedWith($options);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Process\ExifTool');
    }
}
