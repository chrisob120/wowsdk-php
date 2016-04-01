<?php namespace WowApi;

use WowApi\Exceptions\OAuthException;
use WowApi\Util\Helper;
use WowApi\Auth\WowOAuth;

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../src/WowApi/autoload.php';
require_once '../vendor/autoload.php';

$keys = Helper::getKeys('keys.txt');

$client = new WowOAuth($keys['api'], $keys['secret'], 'https://192.168.2.218/wowapi/samples/oauth.php');

if (!isset($_SESSION['response'])) {
    if (!isset($_GET['code'])) {
        $auth_url = $client->getAuthorizationUrl();
        header('Location: ' . $auth_url);
        die('Redirect');
    } else {
        try {
            $response = $client->getAccessToken($_GET['code']);
            Helper::print_rci($response);
        } catch (OAuthException $ex) {
            echo $ex->getError();
        }
    }
} else {
    Helper::print_rci($client->getTokenInfo($_SESSION['response']->access_token));
}

//$z = $client->getAccessToken();

//Helper::print_rci($z);