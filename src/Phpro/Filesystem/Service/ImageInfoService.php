<?php

namespace Phpro\Filesystem\Service;

use Phpro\Filesystem\Cache\LookupCacheAwareInterface;
use Phpro\Filesystem\Cache\ProvidesLookupCacheTrait;
use Phpro\Filesystem\File\FileInterface;
use Phpro\Filesystem\FilesystemAwareInterface;
use Phpro\Filesystem\ProvidesFilesystemTrait;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * Class ImageInfoService
 *
 * @package Filesystem\Service
 */
class ImageInfoService implements
    LookupCacheAwareInterface,
    FilesystemAwareInterface
{

    use ProvidesLookupCacheTrait;
    use ProvidesFilesystemTrait;


    /**
     * @param FileInterface $file
     *
     * @return array|null
     * @throws \Symfony\Component\Filesystem\Exception\FileNotFoundException
     */
    public function getImageInfo(FileInterface $file)
    {
        $this->guardFileExists($file);
        $location = $file->getPath();

        if ($this->hasLookupCache($location)) {
            return $this->getLookupCache($location);
        }

        $imageInfo = getimagesize($location);
        $this->setLookupCache($location, $imageInfo);

        return $imageInfo;
    }

    /**
     * @param FileInterface $file
     *
     * @return array
     */
    public function getExtendedImageInfo(FileInterface $file)
    {
        $this->guardFileExists($file);
        $location = $file->getPath();
        getimagesize($location, $extendedInfo);
        return $extendedInfo;
    }

    /**
     * @param FileInterface $file
     *
     * @throws \Symfony\Component\Filesystem\Exception\FileNotFoundException
     */
    protected function guardFileExists(FileInterface $file)
    {
        $location = $file->getPath();
        $filesystem = $this->getFilesystem();

        if (!$filesystem->exists($location)) {
            throw new FileNotFoundException();
        }
    }

}
