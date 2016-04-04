<?php

/**
 * Auth Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class AuthTest extends PHPUnit_Framework_TestCase {

    /**
     * @var array $_keys
     */
    private $_keys;

    protected function setUp() {
        $this->_keys = $keys = \WowApi\Util\Helper::getKeys('../keys.txt');
    }

    public function testGetTokenInfo() {
        $oauth = new WowApi\Auth\WowOAuth($this->_keys['api'], $this->_keys['secret'], 'https://192.168.2.218/wowapi/examples/oauth.php');
        $oauth->getTokenInfo($this->_keys['token']);
    }

    /**
     * @expectedException \WowApi\Exceptions\IllegalArgumentException
     * @expectedExceptionMessage Protocol must be either http or https
     */
    public function testClientBadProtocol() {
        API::getClient(null, ['protocol' => 'catDog']);
    }

}