<?php namespace WowApi\Cache;

/**
 * Cache engine abstract class
 *
 * @package     Cache
 * @author      Chris O'Brien
 * @version     1.0.0
 */
abstract class CacheEngine implements CacheInterface {

    /**
     * @var string $engineName
     */
    protected $engineName;

    /**
     * @var string|null $engineExtension
     */
    protected $engineExtension = null;

    /**
     * Default first part of the cache key
     * @var string $cacheKey
     */
    protected $cacheKey = 'api_cache';

    /**
     * Check the engine extension if necessary
     */
    public function __construct() {
        // checks if the current engine extension is enabled (if there is an extension)
        if ($this->engineExtension != null) {
            if (!function_exists($this->engineExtension)) {
                throw new \Exception("The $this->engineName extension is not enabled or did not load correctly.");
            }
        }
    }

    /**
     * Get the cache
     *
     * @param string $url
     * @param array $params
     * @return mixed
     */
    public function getCache($url, $params) {
        return $this->get($this->cacheKey . $this->getHash($url, $params));
    }

    /**
     * Set the cache
     *
     * @param string $url
     * @param array $params
     * @param string $apiResponse
     * @return void
     */
    public function setCache($url, $params, $apiResponse) {
        $this->set($this->cacheKey . $this->getHash($url, $params), $apiResponse);
    }

    /**
     * Get the md5 hash of the URL and params
     *
     * @param string $url
     * @param array $params
     * @return string
     */
    private function getHash($url, $params) {
        return md5($url . json_encode($params));
    }

}