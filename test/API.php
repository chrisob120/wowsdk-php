<?php

/**
 * API File
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class API {

    /**
     * Get the WowApi client
     *
     * @param string|null $apiKey
     * @param array|null $options
     * @param bool $token
     * @return \WowApi\WowApi
     */
    public static function getClient($apiKey = null, $options = null, $token = false) {
        $keys = \WowApi\Util\Helper::getKeys(realpath(dirname(__FILE__)). '/keys.txt');

        if ($token) {
            $accessToken = ($token == 'bad') ? $token : $keys['token'];
            $options['access_token'] = $accessToken;
        }

        $key = ($apiKey != null) ? $apiKey : $keys['api'];
        return new \WowApi\WowApi($key, $options);
    }

}