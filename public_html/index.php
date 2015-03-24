<?php
$script_start_time = microtime();

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASEDIR', __DIR__.'/../');
require_once(BASEDIR.'config.php');
require_once(BASEDIR.'classes/AutoLoader.php');

date_default_timezone_set($config['timezone']);

$dispatcher = new Dispatcher();
$dispatcher->run();