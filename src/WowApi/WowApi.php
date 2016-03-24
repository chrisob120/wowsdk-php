<?php namespace WowApi;

use WowApi\Services\CharacterService;

/**
 * WoW API Class
 *
 * Description
 *
 * @author		Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class WowApi {

    public $characterService;

    public function __construct($apiKey) {
        $this->characterService = new CharacterService($apiKey);
    }

}

// example
require_once 'autoload.php';
require_once '../../vendor/autoload.php';

$t = new WowApi('n3hfnyv46xxdu88jp4z9q54qcfmbwgpb');

$g = $t->characterService->getCharacter('Hyjal', 'Ardeel');

echo $g->test;

echo '<pre>';
//print_r($t);
echo '</pre>';