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
        $location = $file->getPath();
        $filesystem = $this->getFilesystem();

        if ($this->hasLookupCache($location)) {
            return $this->getLookupCache($location);
        }

        if (!$filesystem->exists($location)) {
            throw new FileNotFoundException();
        }

        $imageInfo = getimagesize($location);
        $this->setLookupCache($location, $imageInfo);

        return $imageInfo;
    }

}
