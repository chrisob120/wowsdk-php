<?php namespace WowApi;

use WowApi\Exceptions\WowApiException;
use WowApi\Services\CharacterService;
use WowApi\Util\Utilities;

/**
 * WoW API Class
 *
 * Description
 *
 * @author      Chris O'Brien <chris@diobie.com>
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

$t = new WowApi('n3hfnyv46xxdu88jp4z9q54qcfmbwgpb1');

try {
    $g = $t->characterService->getCharacter('Hyjal', 'Ardeel', ['guild', 'jonhdoe', 'pets']);
} catch (WowApiException $ex) {
    Utilities::print_rci($ex->getErrors());
}

//echo $g->test;

echo '<pre>';
//print_r($t);
echo '</pre>';