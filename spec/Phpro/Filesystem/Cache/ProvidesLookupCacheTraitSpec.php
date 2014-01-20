<?php

namespace spec\Phpro\Filesystem\Cache;

use Prophecy\Argument;

trait ProvidesLookupCacheTraitSpec
{
    public function it_should_implement_LookupCacheAwareInterface()
    {
        $this->shouldImplement('Phpro\Filesystem\Cache\LookupCacheAwareInterface');
    }

    public function it_should_know_if_key_exists_in_lookup_cache()
    {
        $this->hasLookupCache('key')->shouldReturn(false);

        $this->setLookupCache('key', 'value');
        $this->hasLookupCache('key')->shouldReturn(true);
    }

    public function it_should_retrieve_key_from_lookup_cache()
    {
        $this->getLookupCache('key')->shouldReturn(null);
        $this->setLookupCache('key', 'value');
        $this->getLookupCache('key')->shouldReturn('value');
    }

    public function it_should_add_key_to_lookup_cache()
    {
        $this->setLookupCache('key', 'value');
        $this->getLookupCache('key')->shouldReturn('value');
    }

    public function it_should_only_use_alfanumeric_lookup_keys()
    {
        $this->normalizeLookupKey('abc\123-;.:@')->shouldReturn('abc123');
    }

}
