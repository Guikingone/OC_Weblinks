<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'dbname'   => '_silex', // Purely in order to test with localhost
    'user'     => 'root',   // Same thing
    'password' => '',       // and again, same thing !
);

// define log level
$app['monolog.level'] = 'WARNING';
