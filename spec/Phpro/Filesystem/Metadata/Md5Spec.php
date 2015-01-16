<?php

namespace spec\Phpro\Filesystem\Metadata;

use Phpro\Filesystem\File\LocalFile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;

class Md5Spec extends AbstractMetadata
{
    public function let(Filesystem $filesystem)
    {
        parent::let($filesystem);
        $this->beConstructedWith($filesystem);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Metadata\Md5');
    }

    public function it_should_be_able_to_load_metadata(Filesystem $filesystem)
    {
        $file = new LocalFile($this->file);

        $this->getMetadataForFile($file)->shouldBe('c98e0c3d617cb63bc7d0a98430bead93');;
    }

}
