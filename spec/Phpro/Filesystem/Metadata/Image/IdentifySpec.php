<?php

namespace spec\Phpro\Filesystem\Metadata\Image;

use Phpro\Filesystem\File\LocalFile;
use spec\Phpro\Filesystem\Metadata\AbstractMetadata;
use Symfony\Component\Filesystem\Filesystem;

class IdentifySpec extends AbstractMetadata
{
    public function let(Filesystem $filesystem, \Imagick $imagick)
    {
        parent::let($filesystem);
        $this->beConstructedWith($filesystem, $imagick);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Metadata\Image\Identify');
    }

    public function it_should_be_able_to_load_metadata(Filesystem $filesystem, \Imagick $imagick)
    {
        $file = new LocalFile($this->file);
        $imagick->readImage($this->file)->shouldBeCalled();
        $imagick->getNumberImages()->willReturn(0);
        $imagick->identifyImage()->willReturn(['key' => 'value']);
        $imagick->getImageProperties('*SpotColor*')->willReturn([1]);
        $imagick->clear()->shouldBeCalled();

        $this->getMetadataForFile($file, ['extended' => true])->shouldReturn([
            'key' => 'value',
            'hasSpotColors' => true,
        ]);
    }
}
