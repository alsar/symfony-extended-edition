<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

// if (isset($_SERVER['HTTP_CLIENT_IP'])
//     || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
//     || !(in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '192.168.100.100', 'fe80::1', '::1')) || php_sapi_name() === 'cli-server')
// ) {
//     header('HTTP/1.0 403 Forbidden');
//     exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
// }

$loader = require_once __DIR__.'/../var/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
