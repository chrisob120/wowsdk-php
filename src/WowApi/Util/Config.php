<?php namespace WowApi\Util;


use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\NotFoundException;

class Config {

    /**
     * @var array - array of default configuration properties
     */
    private static $props = [
        /**
         * Client options
         */
        'client' => [
            'protocol' => 'https',
            'region' => 'us',
            'locale' => 'en_US',
            'base_uri' => ':protocol//:region.api.battle.net/wow/',
            'path' => ':path'
        ],
        /**
         * OAuth2 Authorization related configuration options
         */
        'auth' => [
            'base_url' => 'oauth',
            'response_type_code' => 'code',
            'response_type_token' => 'token'
        ]
    ];

    /**
     * Get the string value with the config locations separated by a period
     *
     * @param string $index
     * @return mixed
     */
    public static function get($index) {
        $index = explode('.', strtolower($index));
        return self::getSingle($index, self::$props);
    }

    /**
     * Get the value from the config file based on the index array
     *
     * @param array $indexArr
     * @param array $configArr
     * @return mixed
     * @throws NotFoundException
     * @throws IllegalArgumentException
     */
    private static function getSingle($indexArr, $configArr) {
        if (count($indexArr) == 2) {
            $catKey = $indexArr[0];
            $valKey = $indexArr[1];

            if (isset($configArr[$catKey][$valKey])) {
                return $configArr[$catKey][$valKey];
            } else {
                throw new NotFoundException('Config item not found.');
            }
        } else {
            throw new IllegalArgumentException('Config parameters incorrectly set.');
        }
    }

}