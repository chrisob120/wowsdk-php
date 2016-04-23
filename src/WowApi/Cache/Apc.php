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
     * {@inheritdoc}
     */
    public function set($key, $val) {
        apc_store($key, $val, 3600);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key) {
        return ($this->keyExists($key)) ? apc_fetch($key) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function keyExists($key) {
        return apc_exists($key);
    }

}