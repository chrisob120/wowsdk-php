<?php namespace WowApi;

use WowApi\Exceptions\WowApiException;
use WowApi\Services\CharacterService;
use WowApi\Services\GuildService;
use WowApi\Services\RealmService;
use WowApi\Util\Helper;

/**
 * WoW API Class
 *
 * Description
 *
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class WowApi {

    /**
     * @var CharacterService $characterService
     */
    public $characterService;

    /**
     * @var RealmService $realmService
     */
    public $realmService;

    /**
     * @var GuildService $guildService
     */
    public $guildService;

    public function __construct($apiKey) {
        $this->characterService = new CharacterService($apiKey);
        $this->realmService = new RealmService($apiKey);
        $this->guildService = new GuildService($apiKey);
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
    //$z = $t->characterService->getCharacter('Hyjal', 'Khaiman', ['mounts']);
    //$z = $t->realmService->getRealm('The Forgotten Coast');
    //$z = $t->realmService->getRealms(['hyjal', 'alterac-mountains', 'stormrage']);
    $z = $t->guildService->getGuild('hyjal', 'tf', ['news']);
    Helper::print_rci($z);
    //Helper::print_rci($g);
} catch (WowApiException $ex) {
    echo $ex->getError();
}