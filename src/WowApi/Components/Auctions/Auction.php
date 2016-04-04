<?php namespace WowApi\Components\Auctions;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Auction
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Auction extends BaseComponent {

    /**
     * @var string $url
     */
    public $url;

    /**
     * @var int $lastModified
     */
    public $lastModified;

    /**
     * Auction constructor - creates the Auction object based on the returned service data
     *
     * @param string $jsonData
     * @return Auction
     */
    public function __construct($jsonData) {
        $data = json_decode($jsonData)->files[0];

        $this->url = $data->url;
        $this->lastModified = $data->lastModified;
    }

}