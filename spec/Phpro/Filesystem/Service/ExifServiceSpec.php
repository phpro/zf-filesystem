<?php

namespace spec\Phpro\Filesystem\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Phpro\Filesystem\Cache\ProvidesLookupCacheTraitSpec;
use spec\Phpro\Filesystem\ProvidesFilesystemTraitSpec;

class ExifServiceSpec extends ObjectBehavior
{

    use ProvidesFilesystemTraitSpec;
    use ProvidesLookupCacheTraitSpec;

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     * @param \PHPExif\Reader  $reader
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     */
    public function let($filesystem, $reader, $hydrator)
    {
        $this->setFilesystem($filesystem);
        $this->setReader($reader);
        $this->setHydrator($hydrator);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Service\ExifService');
    }

    public function it_should_implement_zend_hydratorAwareInterface()
    {
        $this->shouldImplement('Zend\Stdlib\Hydrator\HydratorAwareInterface');
    }

    /**
     * @param \PHPExif\Reader  $reader
     */

    public function it_should_have_an_exif_reader($reader)
    {
        $this->setReader($reader);
        $this->getReader()->shouldReturn($reader);
    }

    /**
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     */
    public function it_should_have_an_hydrator($hydrator)
    {
        $this->setHydrator($hydrator);
        $this->getHydrator()->shouldReturn($hydrator);
    }

    /**
     * @param \Phpro\Filesystem\File\FileInterface $file
     */
    public function it_should_remember_raw_exif_in_lookup($file)
    {
        $file->getPath()->willReturn('file');
        $this->setLookupCache('file', []);
        $this->getRawExifData($file)->shouldReturn([]);
    }

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     * @param \Phpro\Filesystem\File\FileInterface $file
     */
    public function it_should_throw_exception_when_file_could_not_be_found($filesystem, $file)
    {
        $file->getPath()->willReturn('file');
        $filesystem->exists('file')->willReturn(false);

        $this->shouldThrow('Symfony\Component\Filesystem\Exception\FileNotFoundException')->duringGetRawExifData($file);
    }

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     * @param \Phpro\Filesystem\File\FileInterface $file
     * @param \PHPExif\Reader  $reader
     * @param \PHPExif\Exif $exif
     */
    public function it_should_load_md5_from_file($filesystem, $file, $reader, $exif)
    {
        $file->getPath()->willReturn('file');
        $filesystem->exists('file')->willReturn(true);
        $reader->getExifFromFile('file')->willReturn($exif);
        $exif->getRawData()->willReturn([]);

        $this->getRawExifData($file)->shouldReturn([]);
    }

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     * @param \Phpro\Filesystem\File\FileInterface $file
     * @param \PHPExif\Reader  $reader
     * @param \PHPExif\Exif $exif
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @param \stdClass $object
     */
    public function it_should_hydrate_an_iptc_object($filesystem, $file, $reader, $exif, $hydrator, $object)
    {
        // TODO: use right stub
        return;

        $raw = ['author' => 'Toon'];
        $file->getPath()->willReturn('file');
        $filesystem->exists('file')->willReturn(true);
        $reader->getExifFromFile('file')->willReturn($exif);
        $exif->getRawData()->willReturn($raw);
        $hydrator->hydrate($raw, $object)->shouldBeCalled();

        $this->hydrateObject($file, $object)->shouldReturn($raw);
        $object->setAuthor('Toon')->shouldHaveBeenCalled();
    }

}
