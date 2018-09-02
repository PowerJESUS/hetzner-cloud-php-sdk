<?php
//https://docs.hetzner.cloud/#servers-get-metrics-for-a-server

require_once __DIR__ . '/../bootstrap.php';

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