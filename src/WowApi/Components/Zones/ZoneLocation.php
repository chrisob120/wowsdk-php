<?php namespace WowApi\Components\Zones;

use WowApi\Components\BaseComponent;

/**
 * Represents a single ZoneLocation
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ZoneLocation extends BaseComponent {

    /**
     * @var int $id;
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * ZoneLocation constructor - creates the ZoneLocation object based on the returned service data
     *
     * @param object $jsonData
     * @return ZoneLocation
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}