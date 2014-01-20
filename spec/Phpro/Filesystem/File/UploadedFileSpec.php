<?php

namespace spec\Phpro\Filesystem\File;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UploadedFileSpec extends ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith(array(
            'name' => 'filename',
            'tmp_name' => '/tmp/filename',
            'type' => 'image/jpg',
            'error' => null,
            'size' => 132,
         ));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\File\UploadedFile');
    }

    public function it_should_implement_arraySerializable_interface()
    {
        $this->shouldImplement('Zend\Stdlib\ArraySerializableInterface');
    }

    public function it_should_have_a_name()
    {
        $value = 'name';
        $this->setName($value);
        $this->getName()->shouldReturn($value);
    }

    public function it_should_have_a_type()
    {
        $value = 'type';
        $this->setType($value);
        $this->getType()->shouldReturn($value);
    }

    public function it_should_have_a_tmp_name()
    {
        $value = 'tmp-name';
        $this->setTmpName($value);
        $this->getTmpName()->shouldReturn($value);
    }

    public function it_should_have_a_path()
    {
        $value = 'tmp-name';
        $this->setTmpName($value);
        $this->getPath()->shouldReturn($value);
    }

    public function it_should_have_an_error()
    {
        $value = 'error';
        $this->setError($value);
        $this->getError()->shouldReturn($value);
    }

    public function it_should_have_a_size()
    {
        $value = 100;
        $this->setSize($value);
        $this->getSize()->shouldReturn($value);
    }

    public function it_should_exchange_from_array()
    {
        $data = array('name' => 'name');
        $this->exchangeArray($data);

        $this->getname()->shouldReturn('name');
    }

    public function it_should_create_array_copy()
    {
        $data = $this->getArrayCopy();
        $data['name']->shouldBe('filename');
        $data['tmp_name']->shouldBe('/tmp/filename');
        $data['type']->shouldBe('image/jpg');
        $data['error']->shouldBe(null);
        $data['size']->shouldBe(132);
    }

}
