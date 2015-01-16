<?php

namespace spec\Phpro\Filesystem\Metadata\Image;

use Phpro\Filesystem\File\LocalFile;
use spec\Phpro\Filesystem\Metadata\AbstractMetadata;
use Symfony\Component\Filesystem\Filesystem;

class ImageInfoSpec extends AbstractMetadata
{
    public function let(Filesystem $filesystem)
    {
        parent::let($filesystem);
        $this->beConstructedWith($filesystem);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Metadata\Image\ImageInfo');
    }

    public function it_should_be_able_to_load_metadata(Filesystem $filesystem)
    {
        $file = new LocalFile($this->file);

        $result = $this->getMetadataForFile($file, ['extended' => true]);
        $result[0]->shouldBe(1); // width
        $result[1]->shouldBe(1); // height
        $result['extended']->shouldBeArray();
    }
}
