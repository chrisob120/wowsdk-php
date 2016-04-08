<?php namespace WowApi\Services;

use WowApi\Components\Realms\Realm;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\IllegalArgumentException;
use WowApi\Exceptions\NotFoundException;
use WowApi\Exceptions\WowApiException;
use WowApi\Util\Helper;

/**
 * Realm services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class RealmService extends BaseService {

    /**
     * Realm type constants
     */
    const TYPE_PVE = 'pve';
    const TYPE_PVP = 'pvp';
    const TYPE_RP = 'rp';
    const TYPE_RPPVP = 'rppvp';

    /**
     * Queue constants
     */
    const QUEUE_YES = true;
    const QUEUE_NO = false;

    /**
     * Server status constants
     */
    const STATUS_UP = true;
    const STATUS_DOWN = false;

    /**
     * Server population constants
     */
    const POP_LOW = 'low';
    const POP_MEDIUM = 'medium';
    const POP_HIGH = 'high';

    /**
     * @var array $schema
     */
    protected $schema = [
        'type' => [
            self::TYPE_PVE,
            self::TYPE_PVP,
            self::TYPE_RP,
            self::TYPE_RPPVP
        ],
        'queue' => [
            self::QUEUE_YES,
            self::QUEUE_NO
        ],
        'status' => [
            self::STATUS_UP,
            self::STATUS_DOWN
        ],
        'population' => [
            self::POP_LOW,
            self::POP_MEDIUM,
            self::POP_HIGH
        ],
    ];

    /**
     * Gets the realm(s)
     *
     * @param null $realms
     * @return array
     * @throws WowApiException
     * @throws IllegalArgumentException
     */
    public function get($realms = null) {
        $error = false;

        // realms check
        if (is_array($realms)) {
            if (!empty($realms)) {
                // format each array item slug
                foreach ($realms as $key => $realm) $realms[$key] = Helper::formatSlug($realm);
                $this->setQuery(['realms' => implode(',', $realms)]);
            } else {
                $error = true;
            }
        } else if ($realms != null) {
            $error = true;
        }

        // if there is a parameter error, throw an exception
        if ($error) {
            throw parent::toWowApiException(['The realms parameter must be an array with at least one value or null.', 10]);
        }

        $request = parent::createRequest('GET', 'realm/status');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return Realm::getRealms($response->getBody());
    }

    /**
     * Get Realm component
     *
     * @param string $realm Realm slug
     * @return Realm
     * @throws WowApiException
     * @throws NotFoundException
     */
    public function find($realm) {
        $this->setQuery(['realm' => Helper::formatSlug($realm)]);

        $request = parent::createRequest('GET', 'realm/status');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        // if there is more than one result from a getRealm request, that means it was not found. the API returns all realms if the query string search does not find one
        if (count(json_decode($response->getBody())->realms) > 1) {
            throw parent::toWowApiException(['Realm Not Found', 404]);
        } else {
            return new Realm($response->getBody());
        }
    }

    /**
     * @param string $key
     * @param string $val
     * @return array
     * @throws IllegalArgumentException
     */
    public function filter($key, $val) {
        if (!in_array($val, $this->schema[$key])) {
            throw new IllegalArgumentException();
        }

        $this->sortWhitelist = ['type', 'queue', 'status', 'population'];
        return $this->sortData($this->get(), [$key => $val]);
    }

    /**
     *
     */
    public function getDownRealms() {
        $this->filter('status', self::STATUS_DOWN);
    }

    /**
     *
     */
    public function getRealmsWithQueue() {
        $this->filter('queue', self::QUEUE_YES);
    }

}