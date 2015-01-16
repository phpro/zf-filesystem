<?php

namespace spec\Phpro\Filesystem\Metadata\Image;

use Phpro\Filesystem\Initializer\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IdentifySpec extends ObjectBehavior
{
    public function let(Filesystem $filesystem, \Imagick $imagick)
    {
        $this->beConstructedWith($filesystem, $imagick);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Metadata\Image\Identify');
    }
}
