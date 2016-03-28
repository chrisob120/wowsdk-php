<?php namespace WowApi\Components;

use WowApi\Components\Leaderboard\Row;

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
     * @param string $jsonData
     * @return array
     */
    public static function getLeaderboard($jsonData) {
        $returnArr = [];
        $rows = json_decode($jsonData)->rows;

        foreach ($rows as $row) {
            $returnArr[] = new Row(json_encode($row));
        }

        return $returnArr;
    }

}