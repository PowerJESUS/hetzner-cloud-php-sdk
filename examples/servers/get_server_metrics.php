<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../bootstrap.php';
//https://docs.hetzner.cloud/#servers-get-metrics-for-a-server

/*
 * Fetch all servers (optional)
 */
foreach ($hetznerClient->servers()->all() as $server) {
    $start = new \DateTime();
    $start->modify("-1 day");

    $end = new \DateTime();

    /*
     * Get metrics of the last 1hr, for the CPU
     */
    $response = $server->metrics('cpu', $start->format('c'), $end->format('c'));
    $metrics = $response->getResponsePart('metrics');
    /*
     * Display start string
     */
    echo $metrics->start;
}