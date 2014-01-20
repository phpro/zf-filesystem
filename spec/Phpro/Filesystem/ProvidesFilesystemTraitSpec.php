<?php

namespace spec\Phpro\Filesystem;


trait ProvidesFilesystemTraitSpec
{
    public function it_should_implement_filesystemAwareInterface()
    {
        $this->shouldImplement('Phpro\Filesystem\FilesystemAwareInterface');
    }

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     */
    public function it_should_know_the_filesystem($filesystem)
    {
        $this->setFilesystem($filesystem);
        $this->getFilesystem()->shouldReturn($filesystem);
    }
}
