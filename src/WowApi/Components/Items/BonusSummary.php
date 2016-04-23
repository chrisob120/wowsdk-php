<?php namespace WowApi\Components\Items;

use WowApi\Components\BaseComponent;

/**
 * Represents a single BonusSummary
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class BonusSummary extends BaseComponent {

    /**
     * @var array $defaultBonusLists
     */
    public $defaultBonusLists;

    /**
     * @var array $chanceBonusLists
     */
    public $chanceBonusLists;

    /**
     * @var array $bonusChances
     */
    public $bonusChances;

    /**
     * BonusSummary constructor - creates the BonusSummary object based on the returned service data
     *
     * @param object $jsonData
     * @return BonusSummary
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData, null, $param = []);
    }

}