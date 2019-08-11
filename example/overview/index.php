<?php

require '../header.php';

use Compolomus\Prototype\Api;
use Compolomus\Prototype\Utils\Config;
use Compolomus\Prototype\Response;

$config = (new config(include CONFIG_DIR . 'settings.php'))->getConfig();
$db_config = (new config(include CONFIG_DIR . 'db_settings.php'))->getConfig();

$api = new Api($config, $db_config);

$query = [
    'conditions' => [
        'where' => '',
        'limit' => 1,
        'order' => '',
    ],
    'keys' => ['name', 'email', 'perm'],
    'values' => ['test', 'asdas@asd', 1],
];

$response = $api->request('users', 'create', $query)->get();

echo '<pre>' . print_r($response['data'], true) . '</pre>';

$response = $api->request('users', 'read', $query)->get();

echo '<pre>' . print_r($response['data'], true) . '</pre>';

