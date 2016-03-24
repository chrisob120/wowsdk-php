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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// example
require_once 'autoload.php';
require_once '../../vendor/autoload.php';

$t = new WowApi('n3hfnyv46xxdu88jp4z9q54qcfmbwgpb');

try {
    $z = $t->characterService->getCharacter('Hyjal', 'Ardeel', ['appearance']);
    Utilities::print_rci($z);
} catch (WowApiException $ex) {
    echo $ex->getError();
}