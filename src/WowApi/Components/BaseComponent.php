<?php namespace WowApi\Components;

/**
 * Super class for all components
 *
 * @package     Components
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
abstract class BaseComponent {

    /**
     * Base Component
     *
     * @param array $array
     * @param $item
     * @param null $default
     * @return mixed
     */
    protected static function getValue(array $array, $item, $default = null) {
        return (isset($array[$item])) ? $array[$item] : $default;
    }

}