<?php namespace WowApi\Components\Items;

use WowApi\Components\BaseComponent;
use WowApi\Components\Items\ItemSubClass;

/**
 * Represents a single ItemClass
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ItemClass extends BaseComponent {

    /**
     * @var int $class
     */
    public $class;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var array $subclasses
     */
    public $subclasses;

    /**
     * ItemClass constructor - creates the ItemClass object based on the returned service data
     *
     * @param object $jsonData
     * @return ItemClass
     */
    public function __construct($jsonData) {
        $itemClass = parent::assignValues($this, $jsonData);
        if (isset($itemClass->subclasses)) $itemClass->subclasses = $this->getSubClasses($itemClass->subclasses);

        return $itemClass;
    }

    /**
     * @param array $subClassesArr
     * @return array
     */
    private function getSubClasses($subClassesArr = []) {
        $returnArr = [];

        foreach ($subClassesArr as $subClass) {
            $returnArr[] = new ItemSubClass($subClass);
        }

        return $returnArr;
    }

    /**
     * Gets an array of ItemClass items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getItemClasses($jsonData) {
        $returnArr = [];
        $itemClasses = $jsonData->classes;

        foreach ($itemClasses as $itemClass) {
            $returnArr[] = new ItemClass($itemClass);
        }

        return $returnArr;
    }

}