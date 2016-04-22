<?php namespace WowApi\Cache;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use WowApi\Util\Helper;

/**
 * File caching class
 *
 * @package     Cache
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class FileCache extends CacheEngine {

    /**
     * Stored data
     * @var array $_data
     */
    private $_data = [];

    /**
     * Path to cache file
     * @var string $_path
     */
    private $_path;

    /**
     * SimpleCache constructor
     * @param string $path
     * @throws \Exception
     */
    public function __construct($path){
        // check the path
        if (!$path) throw new \Exception('You must set a path for file cache.');
        if (!is_dir($path)) throw new \Exception('The directory path specified was not found.');

        $this->_path = $path;

        $this->engineName = 'File Cache';
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $val) {
        $this->_data[$key] = $val;
        $file = $this->_path. '/' .$key;

        file_put_contents($file, serialize($this->_data[$key]));
    }

    /**
     * {@inheritdoc}
     */
    public function get($key) {
        $file = $this->_path. '/' . $key;

        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }

        if (file_exists($file)) {
            $f = unserialize(file_get_contents($file));
            return $f;
        }

        return (file_exists($file)) ? unserialize(file_get_contents($file)) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function keyExists($key) {
        return true;
    }

}