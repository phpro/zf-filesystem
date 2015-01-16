<?php

namespace spec\Phpro\Filesystem\Metadata;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Filesystem\Filesystem;

abstract class AbstractMetadata extends ObjectBehavior
{
    protected $file = '/tmp/test-file';

    public function let(Filesystem $filesystem)
    {
        $filesystem->exists($this->file)->willReturn(true);

        // Create a file for testing purpose:
        $img = imagecreate(1, 1);
        imagejpeg($img, $this->file);
    }

    public function letgo()
    {
        @unlink($this->file);
    }

    public function it_should_be_a_metadata_provider()
    {
        $this->shouldImplement('Phpro\Filesystem\Metadata\MetadataProvider');
    }
}
