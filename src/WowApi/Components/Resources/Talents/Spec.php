<?php namespace WowApi\Components\Resources\Talents;

use WowApi\Components\BaseComponent;

/**
 * Represents the Spec
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Spec extends BaseComponent {

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $role
     */
    public $role;

    /**
     * @var string $backgroundImage
     */
    public $backgroundImage;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var int $order
     */
    public $order;


    /**
     * Spec constructor - creates the Spec object based on the returned service data
     *
     * @param object $jsonData
     * @return Spec
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

}