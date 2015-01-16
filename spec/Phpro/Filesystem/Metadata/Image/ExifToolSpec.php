<?php

namespace spec\Phpro\Filesystem\Metadata\Image;

use Phpro\Filesystem\Process\ExifTool;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;

class ExifToolSpec extends ObjectBehavior
{
    public function let(Filesystem $filesystem, ExifTool $exifToolProcess)
    {
        $this->beConstructedWith($filesystem, $exifToolProcess);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Metadata\Image\ExifTool');
    }
}
