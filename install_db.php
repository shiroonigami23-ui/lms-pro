<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=utf-8');

try {
    $appConfig = require __DIR__ . '/config/app.php';
    $db = $appConfig['db'];

    $conn = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
    if (!$conn) {
        http_response_code(500);
        echo "DB_CONNECT_FAIL\n";
        echo mysqli_connect_error() . "\n";
        exit;
    }

    $sqlFile = __DIR__ . '/database/library_management_patch.sql';
    if (!file_exists($sqlFile)) {
        http_response_code(500);
        echo "SQL_FILE_NOT_FOUND\n";
        exit;
    }

    $raw = file_get_contents($sqlFile);
    if ($raw === false) {
        http_response_code(500);
        echo "SQL_READ_FAIL\n";
        exit;
    }

    // Normalize line endings and strip SQL comments.
    $raw = str_replace("\r\n", "\n", $raw);
    $lines = explode("\n", $raw);
    $clean = [];
    foreach ($lines as $line) {
        $trim = ltrim($line);
        if ($trim === '' || strpos($trim, '--') === 0) {
            continue;
        }
        $clean[] = $line;
    }
    $sql = implode("\n", $clean);
    $stmts = array_filter(array_map('trim', explode(';', $sql)));

    $ok = 0;
    $ignored = 0;
    $errors = [];

    foreach ($stmts as $stmt) {
        if ($stmt === '') {
            continue;
        }
        $res = mysqli_query($conn, $stmt);
        if ($res) {
            $ok++;
            continue;
        }

        $errno = mysqli_errno($conn);
        // Ignore safe re-run errors.
        if (in_array($errno, [1050, 1061, 1062, 1091], true)) {
            $ignored++;
            continue;
        }
        $errors[] = '[' . $errno . '] ' . mysqli_error($conn);
    }

    if (count($errors) > 0) {
        http_response_code(500);
        echo "DB_IMPORT_PARTIAL_FAIL\n";
        echo "OK=$ok IGNORED=$ignored ERRORS=" . count($errors) . "\n";
        echo implode("\n", $errors) . "\n";
        exit;
    }

    echo "DB_IMPORT_OK\n";
    echo "OK=$ok IGNORED=$ignored\n";
} catch (Throwable $e) {
    http_response_code(500);
    echo "INSTALL_FATAL\n";
    echo $e->getMessage() . "\n";
}

