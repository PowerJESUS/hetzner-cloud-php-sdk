<?php
require_once __DIR__ . '/../bootstrap.php';
/*
 * Prepare objects
 */
$serverType = $hetznerClient->serverTypes()->get(1); //CX11
$location = $hetznerClient->locations()->all('fsn1')[0];
$image = $hetznerClient->images()->all('ubuntu-18.04')[0];
/*
 * Send API call
 */
$apiResponse = $hetznerClient->servers()->createInLocation('my-example-server.test', $serverType, $image, $location);
$server = $apiResponse->getResponsePart('server');
$action = $apiResponse->getResponsePart('action');
echo 'Server: ' . $server->name . PHP_EOL;
echo 'IP: ' . $server->publicNet->ipv4->ip . PHP_EOL;
echo 'Password: ' . $apiResponse->getResponsePart('root_password') . PHP_EOL;
echo 'Now we wait on the success of the server creation!' . PHP_EOL;
echo date('H:i:s') . PHP_EOL;
\LKDev\HetznerCloud\Models\Actions\Actions::waitActionCompleted($action);
echo date('H:i:s') . PHP_EOL;
echo 'Done!';