<?php

/**
 * Auth Tests
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
    public static function getClient($apiKey = null, $options = null) {
        $key = ($apiKey != null) ? $apiKey : 'n3hfnyv46xxdu88jp4z9q54qcfmbwgpb';
        return new \WowApi\WowApi($key, $options);
    }

}