<?php namespace WowApi\Util;


class Utilities {

    public static function urlEncode($input) {
        return urlencode($input);
    }

    public static function print_rci($array = []) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

}