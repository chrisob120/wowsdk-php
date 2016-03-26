<?php namespace WowApi\Util;


/**
 * Class Helper
 *
 * @package     Util
 * @author      Chris O'Brien <chris@diobie.com>
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
     * Replaces all spaces with dashes and puts the string to lower case. This way both the realm name or slug can be entered
     *
     * @param string $slug
     * @return string
     */
    public static function formatSlug($slug) {
        return strtolower(str_replace(' ', '-', $slug));
    }

}