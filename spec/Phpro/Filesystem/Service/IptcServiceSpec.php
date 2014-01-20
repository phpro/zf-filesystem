<?php

namespace spec\Phpro\Filesystem\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Phpro\Filesystem\Cache\ProvidesLookupCacheTraitSpec;

class IptcServiceSpec extends ObjectBehavior
{

    use ProvidesLookupCacheTraitSpec;

    /**
     * @param \Phpro\Filesystem\Service\ImageInfoService $imageInfoService
     * @param \Zend\Stdlib\Hydrator\HydratorInterface$hydrator
     */
    public function let($imageInfoService, $hydrator)
    {
        $this->setImageInfoService($imageInfoService);
        $this->setHydrator($hydrator);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Service\IptcService');
    }

    public function it_should_implement_zend_factoryInterface()
    {
        $this->shouldImplement('Zend\ServiceManager\FactoryInterface');
    }

    public function it_should_implement_zend_hydratorAwareInterface()
    {
        $this->shouldImplement('Zend\Stdlib\Hydrator\HydratorAwareInterface');
    }

    /**
     * @param \Zend\Stdlib\Hydrator\HydratorInterface$hydrator
     */
    public function it_should_have_an_hydrator($hydrator)
    {
        $this->setHydrator($hydrator);
        $this->getHydrator()->shouldReturn($hydrator);
    }

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @param \Phpro\Filesystem\Service\ImageInfoService $imageInfoService
     */
    public function it_should_configure_itself($serviceLocator, $imageInfoService)
    {
        $serviceLocator->get('Phpro\Filesystem\Service\ImageInfoService')->willReturn($imageInfoService);
        $this->createService($serviceLocator)->shouldReturn($this);
        $this->getImageInfoService()->shouldReturn($imageInfoService);
    }

    /**
     * @param \Phpro\Filesystem\Service\ImageInfoService $imageInfoService
     */
    public function it_should_have_an_image_info_service($imageInfoService)
    {
        $this->setImageInfoService($imageInfoService);
        $this->getImageInfoService()->shouldReturn($imageInfoService);
    }

    /**
     * @param \Phpro\Filesystem\File\FileInterface $file
     */
    public function it_should_remember_raw_iptc_in_lookup($file)
    {
        $file->getPath()->willReturn('file');
        $this->setLookupCache('file', []);
        $this->getRawIptcData($file)->shouldReturn([]);
    }

    /**
     * @param \Phpro\Filesystem\Service\ImageInfoService $imageInfoService
     * @param \Phpro\Filesystem\File\FileInterface $file
     */
    public function it_should_throw_exception_when_no_image_data_could_be_found($imageInfoService, $file)
    {
        $file->getPath()->willReturn('file');
        $imageInfoService->getImageInfo($file)->willReturn([]);

        $this->shouldThrow('Symfony\Component\Filesystem\Exception\IOException')->duringGetRawIptcData($file);
    }

    /**
     * @param \Phpro\Filesystem\Service\ImageInfoService $imageInfoService
     * @param \Phpro\Filesystem\File\FileInterface $file
     */
    public function it_should_load_raw_iptc_from_file($imageInfoService, $file)
    {
        // TODO: add
        return;

        $file->getPath()->willReturn('file');
        $imageInfoService->getImageInfo($file)->willReturn(array('APP13' => 'binaryIptcData'));
        $this->getRawIptcData($file)->shouldReturn('x');
    }

}
