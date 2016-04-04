<?php namespace WowApi;

use WowApi\Exceptions\OAuthException;
use WowApi\Util\Helper;
use WowApi\Auth\WowOAuth;

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../src/WowApi/autoload.php';
require_once '../vendor/autoload.php';

// for testing. GET RID OF THIS
$keys = Helper::getKeys('../test/keys.txt');

$oauth = new WowOAuth($keys['api'], $keys['secret'], 'https://192.168.2.218/wowapi/examples/oauth.php');

if (!isset($_SESSION['response'])) {
    if (!isset($_GET['code'])) {
?>
        <button class="btn btn-primary" type="button" onclick="window.location.href='<?php echo $oauth->getAuthorizationUrl(); ?>';">Get Access Token</button>
<?php
    } else {
        try {
            $response = $oauth->getAccessToken($_GET['code']);
            Helper::print_rci($response);
        } catch (OAuthException $ex) {
            echo $ex->getError();
        }
    }
} else {
    echo '<strong>Token:</strong> ' .$_SESSION['response']->access_token;
    Helper::print_rci($oauth->getTokenInfo($_SESSION['response']->access_token));
}