<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASEDIR', __DIR__.'/../');
require_once(BASEDIR.'classes/AutoLoader.php');

$dispatcher = new Dispatcher();
$dispatcher->run();