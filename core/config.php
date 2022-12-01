<?php

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname' => 'satisfy',
        'charset' => 'utf8',
    ),
    'remember' => array(
        'cookieName' => 'hash',
        'cookieExpiry' => 604800
    ),
    'session' => array(
        'sessionName' => 'user',
        'tokenName' => 'token'
    ),
);