<?php

namespace Phpro\Filesystem\Service;

use Phpro\Filesystem\Cache\LookupCacheAwareInterface;
use Phpro\Filesystem\Cache\ProvidesLookupCacheTrait;
use Phpro\Filesystem\File\FileInterface;
use Phpro\Filesystem\FilesystemAwareInterface;
use Phpro\Filesystem\ProvidesFilesystemTrait;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * Class Md5Service
 *
 * @package Filesystem\Service
 */
class Md5Service implements
    LookupCacheAwareInterface,
    FilesystemAwareInterface
{

    use ProvidesLookupCacheTrait;
    use ProvidesFilesystemTrait;

    /**
     * @param FileInterface $file
     *
     * @return null|string
     * @throws \Symfony\Component\Filesystem\Exception\FileNotFoundException
     */
    public function getMd5(FileInterface $file)
    {
        $location = $file->getPath();
        $filesystem = $this->getFilesystem();

        if ($this->hasLookupCache($location)) {
            return $this->getLookupCache($location);
        }

        if (!$filesystem->exists($location)) {
            throw new FileNotFoundException();
        }

        $md5 = md5_file($location);
        $this->setLookupCache($location, $md5);

        return $md5;
    }

}
