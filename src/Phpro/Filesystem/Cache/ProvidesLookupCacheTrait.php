<?php

namespace Phpro\Filesystem\Cache;

/**
 * Class ProvidesLookupCacheTrait
 *
 * @package Filesystem\Cache
 */
trait ProvidesLookupCacheTrait
{

    /**
     * @var array
     */
    protected $lookupCache = [];

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasLookupCache($key)
    {
        $normalized = $this->normalizeLookupKey($key);
        return array_key_exists($normalized, $this->lookupCache);
    }

    /**
     * @param $key
     *
     * @return null
     */
    public function getLookupCache($key)
    {
        if (!$this->hasLookupCache($key)) {
            return null;
        }
        return $this->lookupCache[$key];
    }

    /**
     * @param $key
     * @param $value
     */
    public function setLookupCache($key, $value)
    {
        $normalized = $this->normalizeLookupKey($key);
        $this->lookupCache[$normalized] = $value;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function normalizeLookupKey($key)
    {
        return preg_replace('/[^A-Za-z0-9 ]/', '', $key);
    }

}
