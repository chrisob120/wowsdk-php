<?php namespace WowApi\Exceptions;

use Exception;

/**
 * WowApi Exception
 *
 * @package     Exceptions
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class WowApiException extends Exception {
    /**
     * @var array $_errors
     */
    private $_errors;

    /**
     * @var string $_url
     */
    private $_url;

    /**
     * Errors setter
     *
     * @param array $errors
     * @return void
     */
    public function setErrors($errors = []) {
        $this->_errors = $errors;
    }

    /**
     * Errors getter
     *
     * @return array
     */
    public function getErrors() {
        return $this->_errors;
    }

    /**
     * URL setter
     *
     * @param string $url
     * @return void
     */
    public function setUrl($url) {
        $this->_url = $url;
    }

    /**
     * URL getter
     *
     * @return string
     */
    public function getUrl() {
        return $this->_url;
    }


}