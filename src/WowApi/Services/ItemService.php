<?php namespace WowApi\Services;

use WowApi\Components\Items\Item;
use WowApi\Components\Items\ItemSet;
use WowApi\Components\Items\ItemClass;
use GuzzleHttp\Exception\ClientException;
use WowApi\Exceptions\WowApiException;

/**
 * Item services
 *
 * @package     Services
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ItemService extends BaseService {

    /**
     * Get Item component
     *
     * @param int $itemId
     * @return Item
     * @throws WowApiException
     */
    public function getItem($itemId) {
        $url = $this->getPath('item/:item', [
            'item' => (int)$itemId
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        return new Item($response);
    }

    /**
     * Get ItemSet component
     *
     * @param int $itemSetId
     * @return ItemSet
     * @throws WowApiException
     */
    public function getItemSet($itemSetId) {
        $url = $this->getPath('item/set/:itemSet', [
            'itemSet' => (int)$itemSetId
        ]);

        $request = parent::createRequest('GET', $url);

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }

        $itemSet = new ItemSet($response);
        $itemSet->items = $this->getItemSetItems($itemSet->items);

        return $itemSet;
    }

    /**
     * Gets an array of Items for an ItemSet
     *
     * @param array $itemArr
     * @return array
     */
    private function getItemSetItems($itemArr = []) {
        $returnArr = [];

        if (count($itemArr)) {
            foreach ($itemArr as $itemId) {
                $returnArr[] = $this->getItem($itemId);
            }
        }

        return $returnArr;
    }

    /**
     * Get ItemClass component
     *
     * @return ItemSet
     * @throws WowApiException
     */
    public function getItemClasses() {
        $request = parent::createRequest('GET', 'data/item/classes');

        try {
            $response = parent::doRequest($request);
        } catch (ClientException $e) {
            throw parent::toWowApiException($e);
        }
        
        return ItemClass::getItemClasses($response);
    }
}