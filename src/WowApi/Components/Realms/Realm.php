<?php namespace WowApi\Components\Realms;

use WowApi\Components\BaseComponent;
use WowApi\Util\Helper;

/**
 * Represents a single Realm
 *
 * @package     Components
 * @author      Chris O'Brien <chris@diobie.com>
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
     * Realm constructor - creates the realm object based on the returned service data
     *
     * @param string $jsonData
     * @return Realm
     */
    public function __construct($jsonData) {
        $realObj = json_decode($jsonData)->realms[0];
        return parent::assignValues($this, $realObj, ['tol_barad' => 'tol-barad']);
    }

}