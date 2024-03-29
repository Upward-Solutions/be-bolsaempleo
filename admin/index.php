<?php

define("ROOT", dirname(__FILE__));

$debug = getenv('DEBUG');
if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

include "../domain/autoload.php";
include "../vendor/autoload.php";
include "core/autoload.php";

ob_start();
session_start();
Core::$root = "";

$lb = new Lb();
$lb->start();

?>