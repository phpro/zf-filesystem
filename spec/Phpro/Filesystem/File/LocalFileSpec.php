<?php

namespace spec\Phpro\Filesystem\File;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocalFileSpec extends ObjectBehavior
{

    protected $file = '/tmp/test-file';

    public function let()
    {
        @touch($this->file);
        $this->beConstructedWith($this->file);
    }

    public function letgo()
    {
        @unlink($this->file);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\File\LocalFile');
    }

    public function it_is_a_file()
    {
        $this->shouldImplement('Phpro\FileSystem\File\FileInterface');
    }

    public function it_is_moveable()
    {
        $this->shouldImplement('Phpro\Filesystem\File\Feature\Moveable');
    }

    public function it_should_have_a_name()
    {
        $value = 'test-file';
        $this->getName()->shouldReturn($value);
    }

    public function it_should_have_a_type()
    {
        $value = 'inode/x-empty; charset=binary';
        $this->getType()->shouldReturn($value);
    }

    public function it_should_have_a_path()
    {
        $value = '/tmp/test-file';
        $this->getPath()->shouldReturn($value);
    }

    public function it_should_have_a_size()
    {
        $value = 0;
        $this->getSize()->shouldReturn($value);
    }

    public function it_should_move_the_file()
    {
        $file = $this->file;
        $this->move($file);
        $this->getPath()->shouldBe($file);
    }

}
