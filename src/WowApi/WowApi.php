<?php namespace WowApi;

use WowApi\Services\CharacterService;
use WowApi\Services\GuildService;
use WowApi\Services\RealmService;
use WowApi\Services\MountService;

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

    /**
     * @var MountService $mountService
     */
    public $mountService;

    /**
     * WowApi constructor
     *
     * @param string $apiKey
     * @param array|null $options
     */
    public function __construct($apiKey, $options = null) {
        $this->characterService = new CharacterService($apiKey, $options);
        $this->realmService = new RealmService($apiKey, $options);
        $this->guildService = new GuildService($apiKey, $options);
        $this->mountService = new MountService($apiKey, $options);
    }

}

use WowApi\Exceptions\WowApiException;
use WowApi\Util\Helper;

ini_set('display_errors', 1);
error_reporting(E_ALL);

// example
require_once 'autoload.php';
require_once '../../vendor/autoload.php';

$options = [
    
];

$t = new WowApi('n3hfnyv46xxdu88jp4z9q54qcfmbwgpb', $options);

try {
    //$z = $t->characterService->getCharacter('Hyjal', 'Ardeel');
    //$z = $t->realmService->getRealm('The Forgotten Coast');
    //$z = $t->realmService->getRealms();
    //$z = $t->realmService->sortRealms('type', 'rppvp');
    //$z = $t->guildService->getGuild('hyjal', 'tf', ['news']);
    //$z = $t->mountService->getMounts();
    $z = $t->mountService->sortMounts('isAquatic', false);
    echo count($z);
    Helper::print_rci($z);
} catch (WowApiException $ex) {
    echo $ex->getError();
}