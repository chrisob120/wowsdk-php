<?php namespace WowApi\Cache;

/**
 * Caching interface implemented in all cache engines
 *
 * @package     Cache
 * @author      Chris O'Brien
 * @version     1.0.0
 */
interface CacheInterface {

    /**
     * Set the data item
     *
     * @param string $key
     * @param string $val
     * @return void
     */
    public function set($key, $val);

    /**
     * Return the storage data if the key exists
     *
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Check if the key exists
     *
     * @param string $key
     * @return bool
     */
    public function keyExists($key);

    /**
     * Get the API response from cache
     *
     * @param string $url
     * @param array $params
     * @return mixed
     */
    public function getCache($url, $params);

    /**
     * Set the API response to cache
     *
     * @param string $url
     * @param array $params
     * @param string $apiResponse
     * @return void
     */
    public function setCache($url, $params, $apiResponse);

}