<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'dbname'   => '_silex',
    'user'     => 'root',
    'password' => '',
);

// define log level
$app['monolog.level'] = 'WARNING';
