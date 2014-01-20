<?php

namespace Phpro\Filesystem\Service;

use Phpro\Filesystem\Cache\LookupCacheAwareInterface;
use Phpro\Filesystem\Cache\ProvidesLookupCacheTrait;
use Phpro\Filesystem\File\FileInterface;
use Phpro\Filesystem\Hydrator\IptcHydrator;
use Symfony\Component\Filesystem\Exception\IOException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class IptcService implements
    LookupCacheAwareInterface,
    HydratorAwareInterface,
    FactoryInterface
{

    use ProvidesLookupCacheTrait;


    const IPTC_NAMESPACE = 'APP13';

    /**
     * @var ImageInfoService
     */
    protected $imageInfoService;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return $this
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $imageInfoService = $serviceLocator->get('Phpro\Filesystem\Service\ImageInfoService');
        $this->setImageInfoService($imageInfoService);

        return $this;
    }

    /**
     * @param \Phpro\Filesystem\Service\ImageInfoService $imageInfoService
     */
    public function setImageInfoService($imageInfoService)
    {
        $this->imageInfoService = $imageInfoService;
    }

    /**
     * @return \Phpro\Filesystem\Service\ImageInfoService
     */
    public function getImageInfoService()
    {
        return $this->imageInfoService;
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
            $this->setHydrator(new IptcHydrator());
        }
        return $this->hydrator;
    }

    /**
     * @param FileInterface $file
     *
     * @return array|null
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function getRawIptcData(FileInterface $file)
    {
        $location = $file->getPath();
        if ($this->hasLookupCache($location)) {
            return $this->getLookupCache($location);
        }

        // Load image info:
        $infoService = $this->getImageInfoService();
        $imageInfo = $infoService->getImageInfo($file);
        if (!isset($imageInfo[self::IPTC_NAMESPACE]) || empty($imageInfo[self::IPTC_NAMESPACE])) {
            throw new IOException(sprintf('No IPTC data available for file: %s', $location));
        }

        // Parse IPTC data
        $parsed = @iptcparse($imageInfo[self::IPTC_NAMESPACE]);
        if (!$parsed) {
            throw new IOException(sprintf('IPTC data could not be read from file: %s', $location));
        }

        $this->setLookupCache($location, $parsed);
        return $parsed;

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
        $raw = $this->getRawIptcData($file);
        $hydrator = $this->getHydrator();
        $hydrator->hydrate($raw, $object);

        return $raw;
    }

}
