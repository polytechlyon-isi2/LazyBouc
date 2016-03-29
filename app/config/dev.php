<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',  // Mandatory for PHPUnit testing
    'port'     => '3306',
    'dbname'   => 'lazybouc',
    'user'     => 'lazybouc_user',
    'password' => 'l4zyb0uc',
);

// enable the debug mode
$app['debug'] = true;
$app['monolog.level'] = 'INFO';