<?php namespace WowApi\Services;

/**
 * Service Interface
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
interface ServiceInterface {

    /**
     * The get method with optionals params
     *
     * @param array|null $get
     * @return mixed
     */
    public function get($get = null);

    /**
     * Find a specific item
     *
     * @param string $find
     * @return mixed
     */
    public function find($find);

    /**
     * @param string $key
     * @param string $val
     * @return mixed
     */
    public function filter($key, $val);

}