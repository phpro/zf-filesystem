<?php

namespace spec\Phpro\Filesystem\Hydrator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IptcHydratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Hydrator\IptcHydrator');
    }

    public function it_should_extend_classmap_hydrator()
    {
        $this->shouldHaveType('Zend\Stdlib\Hydrator\ClassMethods');
    }

    public function it_should_have_a_mapper_method()
    {
        $this->getFieldMapper()->shouldBeArray();
    }

    /**
     * @param \stdClass $iptc
     */
    public function it_should_hydrate($iptc)
    {
        // Todo: add all options + valid iptc stub
        return;

        $data = array(
            '2#120' => 'caption',
        );

        $this->hydrate($data, $iptc);
        $data->setCaption('caption')->shouldBeCalled();
    }

    /**
     * @param \stdClass $iptc
     */
    public function it_should_extract($iptc)
    {
        // Todo: add all options + valid iptc stub
        return;


        $caption = 'caption';
        $iptc->getCaption()->willReturn($caption);
        $result = $this->extract($iptc);

        $result->shouldBeArray();
        $result['2#120']->shouldBe(array($caption));
    }
}
