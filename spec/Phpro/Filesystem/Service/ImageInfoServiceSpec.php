<?php

namespace spec\Phpro\Filesystem\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Phpro\Filesystem\Cache\ProvidesLookupCacheTraitSpec;
use spec\Phpro\Filesystem\ProvidesFilesystemTraitSpec;

class ImageInfoServiceSpec extends ObjectBehavior
{

    use ProvidesFilesystemTraitSpec;
    use ProvidesLookupCacheTraitSpec;

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     */
    public function let($filesystem)
    {
        $this->setFilesystem($filesystem);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Service\ImageInfoService');
    }

    /**
     * @param \Phpro\Filesystem\File\FileInterface $file
     */
    public function it_should_remember_image_info_in_lookup($file)
    {
        $file->getPath()->willReturn('file');
        $this->setLookupCache('file', []);
        $this->getImageInfo($file)->shouldReturn([]);
    }

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     * @param \Phpro\Filesystem\File\FileInterface $file
     */
    public function it_should_throw_exception_when_file_could_not_be_found($filesystem, $file)
    {
        $file->getPath()->willReturn('file');
        $filesystem->exists('file')->willReturn(false);

        $this->shouldThrow('Symfony\Component\Filesystem\Exception\FileNotFoundException')->duringGetImageInfo($file);
    }

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     * @param \Phpro\Filesystem\File\FileInterface $file
     */
    public function it_should_load_image_info_from_file($filesystem, $file)
    {

        // TODO: add file to check info...
        return;

        $file->getPath()->willReturn('file');
        $filesystem->exists('file')->willReturn(true);

        $this->getImageInfo($file)->shouldReturn([]);
    }

}
