<?php
// One-time DB bootstrap for first live hit on /library/.
$marker = __DIR__ . '/.db_installed';
if (!file_exists($marker)) {
    $appConfig = require __DIR__ . '/config/app.php';
    require_once __DIR__ . '/config/database.php';
    $connection = @lms_db_connect($appConfig['db']);
    if ($connection) {
        $sqlFile = __DIR__ . '/database/library_management_patch.sql';
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            if ($sql !== false && @mysqli_multi_query($connection, $sql)) {
                do {
                    if ($result = mysqli_store_result($connection)) {
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($connection));
                @file_put_contents($marker, date('c'));
            }
        }
    }
}

header("Location: /library/User/index.php");
exit();

