<?php

require '../header.php';

use Compolomus\Prototype\Api;
use Compolomus\Prototype\Utils\Config;
use Compolomus\Prototype\Response;

$config = (new config(include CONFIG_DIR . 'settings.php'))->getConfig();
$db_config = (new config(include CONFIG_DIR . 'db_settings.php'))->getConfig();

$api = new Api($config, $db_config);


// Insert
$query = [
    'keys' => ['name', 'email', 'perm'],
    'values' => ['test', 'asdas@asd', 1],
];

$response = $api->request('users', 'create', $query)->get();

echo '<pre>' . print_r($response['data'], true) . '</pre>';

// Read

$query = [
    'conditions' => [
        'where' => 'id = 3',
        'limit' => 1,
        'order' => '',
    ],
];

$response = $api->request('users', 'read', $query)->get();

echo '<pre>' . print_r($response['data'], true) . '</pre>';

// Update

$query = [
    'keys' => ['name', 'email', 'perm'],
    'values' => ['test2', 'asdas11@asd', 2],
    'conditions' => [
        'where' => 'id = 3',
        'limit' => 1,
        'order' => '',
    ],
];

$response = $api->request('users', 'update', $query)->get();

echo '<pre>' . print_r($response['data'], true) . '</pre>';

//Read 2

$query = [
    'conditions' => [
        'where' => 'id = 3',
        'limit' => 1,
        'order' => '',
    ],
];

$response = $api->request('users', 'read', $query)->get();

echo '<pre>' . print_r($response['data'], true) . '</pre>';

// Delete

$query = [
    'conditions' => [
        'where' => 'id > 2',
        'limit' => 1,
    ],
];

$response = $api->request('users', 'delete', $query)->get();

echo '<pre>' . print_r($response['data'], true) . '</pre>';
