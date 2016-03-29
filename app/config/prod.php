<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => getenv('OPENSHIFT_MYSQL_DB_HOST');,
    'port'     => '3306',
    'dbname'   => getenv('OPENSHIFT_GEAR_NAME'),
    'user'     => getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
    'password' => getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),
);

$app['monolog.level'] = 'WARNING';
