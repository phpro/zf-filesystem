<?php

namespace spec\Phpro\Filesystem\Event;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileUploadEventSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\Filesystem\Event\FileUploadEvent');
    }

    public function it_should_extend_event()
    {
        $this->shouldHaveType('Zend\EventManager\Event');
    }

    /**
     * @param \Phpro\Filesystem\File\UploadedFile $uploadedFile
     */
    public function it_should_have_uploaded_file($uploadedFile)
    {
        $this->setUploadedFile($uploadedFile);
        $this->getUploadedFile()->shouldReturn($uploadedFile);
    }
}
