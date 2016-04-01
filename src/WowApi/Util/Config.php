<?php namespace WowApi\Util;

use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\NotFoundException;

/**
 * Config Helper
 *
 * @package     Util
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Config {

    /**
     * @var array $props Default configuration properties
     */
    private static $props = [
        /**
         * Client options
         */
        'client' => [
            'base_uri'  => ':protocol//:region.api.battle.net/wow/',
            'protocol'  => 'https',
            'region'    => 'us',
            'locale'    => 'en_US'
        ],
        /**
         * Regions and their allowed locales
         */
        'regions' => [
            'us' => ['en_US', 'es_MX', 'pt_BR'],
            'eu' => ['en_GB', 'es_ES', 'fr_FR', 'ru_RU', 'de_DE', 'pt_PT', 'it_IT'],
            'kr' => ['ko_KR'],
            'tw' => ['zh_TW']
        ],
        /**
         * OAuth2 Authorization related configuration options
         */
        'oauth' => [
            'base_uri'                  => 'https://:region.battle.net/oauth/',
            'authorization_endpoint'    => 'authorize',
            'token_endpoint'			=> 'token',
            'check_token_endpoint'      => 'check_token',
            'response_type'             => 'code',
            'authorization_grant_type'  => 'authorization_code',
            'scope'                     => 'wow.profile'
        ]
    ];

    /**
     * Get the string value with the config locations separated by a period
     *
     * @param string $index
     * @return mixed
     */
    public static function get($index) {
        $indexArr = explode('.', strtolower($index));

        return self::getSingle($indexArr, self::$props);
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
        } else if (count($indexArr) == 1) {
            $catKey = $indexArr[0];

            if (isset($configArr[$catKey])) {
                return $configArr[$catKey];
            } else {
                throw new NotFoundException('Config item not found.');
            }
        } else {
            throw new IllegalArgumentException('Config parameters incorrectly set.');
        }
    }

}