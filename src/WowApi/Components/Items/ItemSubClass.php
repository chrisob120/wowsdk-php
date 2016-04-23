<?php namespace WowApi\Components\Items;

use WowApi\Components\BaseComponent;

/**
 * Represents a single ItemClass
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ItemSubClass extends BaseComponent {

    /**
     * @var int $subclass
     */
    public $subclass;

    /**
     * @var string $name
     */
    public $name;

    /**
     * ItemSubClass constructor - creates the ItemSubClass object based on the returned service data
     *
     * @param object $jsonData
     * @return ItemSubClass
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

}