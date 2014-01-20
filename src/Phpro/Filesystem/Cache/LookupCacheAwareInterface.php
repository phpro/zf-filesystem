<?php

namespace Phpro\Filesystem\Cache;

/**
 * Interface LookupCacheInterface
 *
 * @package Filesystem\Cache
 */
interface LookupCacheAwareInterface
{

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasLookupCache($key);

    /**
     * @param $key
     *
     * @return null
     */
    public function getLookupCache($key);

    /**
     * @param $key
     * @param $value
     */
    public function setLookupCache($key, $value);
    /**
     * @param $key
     *
     * @return mixed
     */
    public function normalizeLookupKey($key);

}
