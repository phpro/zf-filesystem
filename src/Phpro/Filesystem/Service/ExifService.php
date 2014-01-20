<?php

namespace Phpro\Filesystem\Service;

use Phpro\Filesystem\Cache\LookupCacheAwareInterface;
use Phpro\Filesystem\Cache\ProvidesLookupCacheTrait;
use Phpro\Filesystem\File\FileInterface;
use Phpro\Filesystem\FilesystemAwareInterface;
use Phpro\Filesystem\ProvidesFilesystemTrait;
use PHPExif\Reader;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\IOException;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Class ExifService
 *
 * @package Filesystem\Service
 */
class ExifService implements
    LookupCacheAwareInterface,
    HydratorAwareInterface,
    FilesystemAwareInterface
{

    use ProvidesLookupCacheTrait;
    use ProvidesFilesystemTrait;


    /**
     * @var Reader
     */
    protected $reader;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * @param \PHPExif\Reader $reader
     */
    public function setReader($reader)
    {
        $this->reader = $reader;
    }

    /**
     * @return \PHPExif\Reader
     */
    public function getReader()
    {
        if (!$this->reader) {
            $this->reader = Reader::factory(Reader::TYPE_NATIVE);
        }
        return $this->reader;
    }

    /**
     * @param HydratorInterface $hydrator
     *
     * @return void|HydratorAwareInterface
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if (!$this->hydrator) {
            $this->setHydrator(new ClassMethods());
        }
        return $this->hydrator;
    }

    /**
     * @param FileInterface $file
     *
     * @return array
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function getRawExifData(FileInterface $file)
    {

        $location = $file->getPath();
        if ($this->hasLookupCache($location)) {
            return $this->getLookupCache($location);
        }

        $filesystem = $this->getFilesystem();
        if (!$filesystem->exists($location)) {
            throw new FileNotFoundException();
        }

        try {
            $reader = $this->getReader();
            $exif = $reader->getExifFromFile($location);
            $raw = $exif->getRawData();
            foreach ($raw as $key => $value) {
                if (!$value) {
                    $raw[$key] = null;
                }
            }
        } catch (\Exception $e) {
            throw new IOException(sprintf('Exif data could not be read from file: %s', $location));
        }


        $this->setLookupCache($location, $raw);
        return $raw;
    }

    /**
     * This method will hydrate your object with the raw IPTC data.
     * Make sure that your object fits the neends of the IPTC hydrator.
     *
     * @param FileInterface $file
     * @param               $object
     *
     * @return array
     */
    public function hydrateObject(FileInterface $file, $object)
    {
        $raw = $this->getRawExifData($file);
        $hydrator = $this->getHydrator();
        $hydrator->hydrate($raw, $object);

        return $raw;
    }

}
