<?php namespace WowApi\Components\Leaderboard;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Leaderboard
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Leaderboard extends BaseComponent {

    /**
     * Gets an array of Row items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getLeaderboard($jsonData) {
        $returnArr = [];
        $rows = $jsonData->rows;

        foreach ($rows as $row) {
            $returnArr[] = new Row($row);
        }

        return $returnArr;
    }

}