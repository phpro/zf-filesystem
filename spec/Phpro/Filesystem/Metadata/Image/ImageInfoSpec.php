<?php

namespace spec\Phpro\Filesystem\Metadata\Image;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;

class ImageInfoSpec extends ObjectBehavior
{
    public function let(Filesystem $filesystem)
    {
        $this->beConstructedWith($filesystem);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Metadata\Image\ImageInfo');
    }
}
