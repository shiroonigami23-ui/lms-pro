<?php
$appConfig = require __DIR__ . '/app.php';
$dbConfig = $appConfig['db'];

function lms_db_connect(array $dbConfig): mysqli
{
    $connection = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['pass']);
    if (!$connection) {
        die('Database connection failed: ' . mysqli_connect_error());
    }
    if (!mysqli_select_db($connection, $dbConfig['name'])) {
        die('Database selection failed: ' . mysqli_error($connection));
    }
    return $connection;
}

