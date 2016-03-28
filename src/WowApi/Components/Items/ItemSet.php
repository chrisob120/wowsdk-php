<?php namespace WowApi\Components\Items;

use WowApi\Components\BaseComponent;

/**
 * Represents a single ItemSet
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ItemSet extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var array $setBonuses
     */
    public $setBonuses;

    /**
     * @var array $items
     */
    public $items;

    /**
     * ItemSet constructor - creates the ItemSet object based on the returned service data
     *
     * @param string $jsonData
     * @return ItemSet
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}