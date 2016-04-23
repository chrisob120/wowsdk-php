<?php namespace WowApi\Components\Realms;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Realm
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Realm extends BaseComponent {

    /**
     * @var string $type
     */
    public $type;

    /**
     * @var string $population
     */
    public $population;

    /**
     * @var mixed $queue
     */
    public $queue;

    /**
     * @var object $wintergrasp
     */
    public $wintergrasp;

    /**
     * @var object $tolBarad
     */
    public $tol_barad;

    /**
     * @var int $status
     */
    public $status;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $slug
     */
    public $slug;

    /**
     * @var string $battlegroup
     */
    public $battlegroup;

    /**
     * @var string $locale
     */
    public $locale;

    /**
     * @var string $timezone
     */
    public $timezone;

    /**
     * @var array $connected_realms
     */
    public $connected_realms;

    /**
     * Realm constructor - creates the Realm object based on the returned service data
     *
     * @param object $jsonData
     * @return Realm
     */
    public function __construct($jsonData) {
        // checks which method the data is coming in from. if it's a multiple realm request, there will be no 'realms' property on the response object because it gets the Realm object one by one
        $realObj = (!property_exists($jsonData, 'realms')) ? $jsonData : $jsonData->realms[0];
        return parent::assignValues($this, $realObj, ['tol_barad' => 'tol-barad'],  $default = 'remove');
    }

    /**
     * Gets an array of Realm items based on which realms were sent to the method
     *
     * @param object $jsonData
     * @return array
     */
    public static function getRealms($jsonData) {
        $returnArr = [];
        $realms = $jsonData->realms;

        foreach ($realms as $realm) {
            $returnArr[] = new Realm($realm);
        }

        return $returnArr;
    }

}