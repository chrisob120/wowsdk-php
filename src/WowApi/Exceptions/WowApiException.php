<?php namespace WowApi\Exceptions;

use Exception;

/**
 * WowApi Exception
 *
 * @package     Exceptions
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class WowApiException extends Exception {
    /**
     * @var array $_error
     */
    private $_error;

    /**
     * Error setter
     *
     * @param array $errors
     * @return void
     */
    public function setError($errors) {
        //$this->_error = $errors;

        // use this format while in experimental phase
        $this->_error = 'Error: ';
        $this->_error.= "<pre>{\n";

        foreach ($errors as $key => $val) {
            if ($val == 'Account Inactive') {
                $this->_error.= "&nbsp;&nbsp;&nbsp;<strong>$key</strong>: $val (probably means bad API key)\n";
            } else {
                $this->_error.= "&nbsp;&nbsp;&nbsp;<strong>$key</strong>: $val\n";
            }
        }

        $this->_error.= '}</pre>';
    }

    /**
     * Error getter
     *
     * @return array
     */
    public function getError() {
        return $this->_error;
    }


}