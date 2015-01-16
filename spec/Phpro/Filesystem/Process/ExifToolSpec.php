<?php

namespace spec\Phpro\Filesystem\Process;

use Phpro\Filesystem\File\LocalFile;
use Phpro\Filesystem\Options\ExifToolOptions;
use PhpSpec\ObjectBehavior;

class ExifToolSpec extends ObjectBehavior
{
    protected $file = '/tmp/test-file';

    public function let(ExifToolOptions $options)
    {
        $this->beConstructedWith($options);
        $options->getExecutable()->willReturn('/usr/local/bin/exiftool');
        $options->getAllowedTags()->willReturn(['xmp', 'exif', 'iptc']);

        // Create a file for testing purpose:
        $img = imagecreate(1, 1);
        imagejpeg($img, $this->file);
    }

    public function letgo()
    {
        @unlink($this->file);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Process\ExifTool');
    }

    /**
     * should be able to scan file metadata
     */
    public function it_should_be_able_to_scan_file_metadata()
    {
        $file = new LocalFile($this->file);

        $result = $this->scanFile($file);
        $result->shouldBeArray();
        $result['SourceFile']->shouldBe($this->file);
    }
}
