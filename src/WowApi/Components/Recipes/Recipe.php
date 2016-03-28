<?php namespace WowApi\Components\Recipes;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Recipe
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Recipe extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $profession
     */
    public $profession;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * Recipe constructor - creates the Recipe object based on the returned service data
     *
     * @param string $jsonData
     * @return Recipe
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}