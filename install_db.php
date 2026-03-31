<?php
header('Content-Type: text/plain; charset=utf-8');

$appConfig = require __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';

$connection = lms_db_connect($appConfig['db']);
$sqlFile = __DIR__ . '/database/library_management_patch.sql';

if (!file_exists($sqlFile)) {
    http_response_code(500);
    echo "SQL_FILE_NOT_FOUND\n";
    exit;
}

$sqlRaw = file_get_contents($sqlFile);
if ($sqlRaw === false) {
    http_response_code(500);
    echo "SQL_READ_FAIL\n";
    exit;
}

$statements = array_filter(array_map('trim', explode(';', $sqlRaw)));
$errors = [];
$ok = 0;

foreach ($statements as $stmt) {
    if ($stmt === '' || strpos($stmt, '--') === 0) {
        continue;
    }
    if (@mysqli_query($connection, $stmt)) {
        $ok++;
        continue;
    }
    $errno = mysqli_errno($connection);
    // Ignore "already exists" style re-run errors.
    if (in_array($errno, [1050, 1061, 1062, 1091], true)) {
        continue;
    }
    $errors[] = "[$errno] " . mysqli_error($connection);
}

if (count($errors) === 0) {
    echo "DB_IMPORT_OK\n";
    echo "STATEMENTS_OK=$ok\n";
} else {
    http_response_code(500);
    echo "DB_IMPORT_PARTIAL_FAIL\n";
    echo implode("\n", $errors) . "\n";
}
