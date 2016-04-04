<?php

/**
 * API File
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class API {

    /**
     * @param string|null $apiKey
     * @param array|null $options
     * @return \WowApi\WowApi
     */
    public static function getClient($apiKey, $options = null) {
        return new \WowApi\WowApi($apiKey, $options);
    }

}