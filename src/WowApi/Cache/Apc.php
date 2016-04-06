<?php namespace WowApi\Cache;

/**
 * APC Cache Engine
 *
 * @package     Cache
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Apc extends CacheEngine {

    /**
     * Apc constructor
     */
    public function __construct(){
        $this->engineName = 'APC';
        $this->engineExtension = 'apc_store';

        parent::__construct();
    }

    /**
     * Set the data item with a ttl to only last through the request
     *
     * @param string $key
     * @param string $val
     * @return void
     */
    public function set($key, $val) {
        apc_store($key, $val, ['ttl' => 3600]);
    }

    /**
     * Return the storage data if the key exists
     *
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        return ($this->keyExists($key)) ? apc_fetch($key) : null;
    }

    /**
     * Check if the key exists
     *
     * @param string $key
     * @return bool
     */
    public function keyExists($key) {
        return apc_exists($key);
    }

}