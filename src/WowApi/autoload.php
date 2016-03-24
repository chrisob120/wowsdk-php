<?php
require_once('SplClassLoader.php');

// Load the WowApi namespace
$loader = new \WowApi\SplClassLoader('WowApi', dirname(__DIR__));
$loader->register();