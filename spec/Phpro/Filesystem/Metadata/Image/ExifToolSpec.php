<?php

namespace spec\Phpro\Filesystem\Metadata\Image;

use Phpro\Filesystem\File\LocalFile;
use Phpro\Filesystem\Process\ExifTool;
use spec\Phpro\Filesystem\Metadata\AbstractMetadata;
use Symfony\Component\Filesystem\Filesystem;

class ExifToolSpec extends AbstractMetadata
{
    public function let(Filesystem $filesystem, ExifTool $exifToolProcess)
    {
        parent::let($filesystem);
        $this->beConstructedWith($filesystem, $exifToolProcess);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Metadata\Image\ExifTool');
    }

    public function it_should_be_able_to_load_metadata(Filesystem $filesystem, ExifTool $exifToolProcess)
    {
        $file = new LocalFile($this->file);
        $result = ['tag' => []];
        $exifToolProcess->scanFile($file, 'tag')->willReturn($result);

        $this->getMetadataForFile($file, ['tag' => 'tag'])->shouldReturn($result);
    }
}
