<?php

// Redirigir apex a www
$host = $_SERVER['HTTP_HOST'] ?? '';
if ($host === 'bolsabeempleo.com.ar') {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    header('Location: https://www.bolsabeempleo.com.ar' . $uri, true, 301);
    exit;
}

$debug= getenv('DEBUG');
if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    error_reporting(0);	
}


include "core/autoload.php";
ob_start();
session_start();

$lb = new Lb();
$lb->start();
