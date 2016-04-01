<?php namespace WowApi\Util;

/**
 * Class Helper
 *
 * @package     Util
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Helper {

    /**
     * @param $input
     * @return mixed
     */
    public static function urlEncode($input) {
        return urlencode($input);
    }

    /**
     * @param array $array
     * @return void
     */
    public static function print_rci($array = []) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    /**
     * Replaces all spaces with dashes, all apostrophe's with empty strings, and puts the string to lower case.
     * This allows for both the realm name or slug to be entered.
     *
     * @param string $slug
     * @return string
     */
    public static function formatSlug($slug) {
        $returnStr = str_replace(' ', '-', $slug);
        return strtolower(str_replace("'", '', $returnStr));
    }

    /**
     * Checks the protocol to confirm colon
     *
     * @param string $protocol
     * @return string
     */
    public static function checkProtocol($protocol) {
        return (substr($protocol, -1) == ':') ? $protocol : "$protocol:";
    }

    /**
     * @param string $file
     * @return mixed
     */
    public static function getKeys($file) {
        $file = file($file);

        // get the keys
        $publicKey = explode('=', $file[0])[1];
        $privateKey  = explode('=', $file[1])[1];

        return [
            'api' => trim($publicKey),
            'secret' => trim($privateKey)
        ];
    }

}