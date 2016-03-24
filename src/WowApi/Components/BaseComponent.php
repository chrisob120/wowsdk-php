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
     * Assign the values to an object
     *
     * @param object $componentObj
     * @param object $apiObj
     * @param null $default
     * @return object;
     */
    protected static function assignValues($componentObj, $apiObj, $default = null) {
        foreach ($componentObj as $prop => $val) {
            $componentObj->$prop = (isset($apiObj->$prop)) ? $apiObj->$prop : $default;
        }

        return $componentObj;
    }

}