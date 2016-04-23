<?php namespace WowApi\Components\Resources;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Battlegroup
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Battlegroup extends BaseComponent {

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $slug
     */
    public $slug;

    /**
     * Battlegroup constructor - creates the Battlegroup object based on the returned service data
     *
     * @param object $jsonData
     * @return Battlegroup
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

    /**
     * Gets an array of Battlegroup items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getBattlegroups($jsonData) {
        $returnArr = [];
        $battlegroups = $jsonData->battlegroups;

        foreach ($battlegroups as $battlegroup) {
            $returnArr[] = new Battlegroup($battlegroup);
        }

        return $returnArr;
    }

}