<?php namespace WowApi;

use WowApi\Exceptions\WowApiException;
use WowApi\Util\Helper;

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../src/WowApi/autoload.php';
require_once '../vendor/autoload.php';

$keys = Helper::getKeys('keys.txt');

$options = [
    'region' => 'us',
    'locale' => 'en_US',
    'access_token' => $_SESSION['response']->access_token
];

//$options = ['region' => 'eu', 'locale' => 'en_GB'];

try {
    $t = new WowApi($keys['api'], $options);

    //$z = $t->achievementService->getAchievement(150);
    //$z = $t->auctionService->getAuction('Hyjal');
    //$z = $t->bossService->getBoss(24723);
    //$z = $t->challengeService->getLadder('Hyjal');
    //$z = $t->challengeService->getLadderByDungeon('Hyjal', 'Auchindoun');
    //$z = $t->challengeService->getRegionLadder();
    //$z = $t->characterService->getCharacter('Hyjal', 'Ardeel');
    //$z = $t->characterService->getCharacterClasses();
    //$z = $t->characterService->getCharacterRaces();
    //$z = $t->characterService->getCharacterAchievements();
    //$z = $t->guildService->getGuild('hyjal', 'tf');
    //$z = $t->guildService->getGuildRewards();
    //$z = $t->guildService->getGuildPerks();
    //$z = $t->guildService->getGuildAchievements();
    //$z = $t->itemService->getItem(71033);
    //$z = $t->itemService->getItemSet(1060);
    //$z = $t->itemService->getItemClasses();
    //$z = $t->leaderboardService->getLeaderboard('rbg');
    //$z = $t->mountService->getMounts();
    //$z = $t->mountService->sortMounts('isAquatic', false);
    //$z = $t->petService->getPets();
    //$z = $t->petService->getSpecies(258);
    //$z = $t->petService->getSpeciesStats(258, ['level' => 80, 'breedId' => 5, 'qualityId' => 4]);
    //$z = $t->petService->getPetTypes();
    //$z = $t->questService->getQuest(13146);
    //$z = $t->realmService->getRealm('hyjal');
    //$z = $t->realmService->getRealms(['hyjal', 'stormrage']);
    //$z = $t->realmService->sortRealms('type', 'rppvp');
    //$z = $t->recipeService->getRecipe(33994);
    //$z = $t->resourceService->getBattlegroups();
    //$z = $t->resourceService->getTalentTree();
    //$z = $t->spellService->getSpell(8056);
    //$z = $t->zoneService->getZones();
    //$z = $t->zoneService->getZone(4131);
    //$z = $t->userService->getProfile();
    //$z = $t->userService->getUserAccountId();
    $z = $t->userService->getUserBattletag();
    echo '<strong>Returned:</strong> ' .count($z);
    Helper::print_rci($z);
} catch (WowApiException $ex) {
    echo $ex->getError();
    //Helper::print_rci($ex->getError());
}