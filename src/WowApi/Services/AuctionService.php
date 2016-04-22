<?php namespace WowApi\Services;

use WowApi\Components\Auctions\Auction;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Auction services
 *
 * TODO: Make this actually do something
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class AuctionService extends BaseService {

    /**
     * Get Auction component
     *
     * @param string $realm
     * @return Auction
     * @throws WowApiException
     */
    public function getAuction($realm) {
        $url = $this->getPath('auction/data/:realm', [
            'realm' => $realm
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Auction($response);
    }
}