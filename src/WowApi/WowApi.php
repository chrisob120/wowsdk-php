<?php namespace WowApi;

use WowApi\Services\CharacterService;
use WowApi\Services\GuildService;
use WowApi\Services\RealmService;
use WowApi\Services\MountService;
use WowApi\Util\Config;

/**
 * WoW API Class
 *
 * Description
 *
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class WowApi {


    private $_clientOptions = [];

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

    public function __construct($apiKey) {
        echo Config::get('client.url');
        // default client options
        $this->_clientOptions = [

        ];

        $this->characterService = new CharacterService($apiKey);
        $this->realmService = new RealmService($apiKey);
        $this->guildService = new GuildService($apiKey);
        $this->mountService = new MountService($apiKey);
    }

}

use WowApi\Components\Mount;
use WowApi\Exceptions\WowApiException;
use WowApi\Util\Helper;



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
    $z = $t->realmService->getRealms();
    //$z = $t->realmService->sortRealms('type', 'rppvp');
    //$z = $t->guildService->getGuild('hyjal', 'tf', ['news']);
    //$z = $t->mountService->getMounts();
    //echo count($z);
    //Helper::print_rci($z);
} catch (WowApiException $ex) {
    echo $ex->getError();
}