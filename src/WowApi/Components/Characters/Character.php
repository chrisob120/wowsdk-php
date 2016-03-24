<?php namespace WowApi\Components\Characters;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Character
 *
 * @package     Components
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class Character extends BaseComponent {

    public function __construct($t) {
        echo $t;
    }

    public $test = 'ya';

}