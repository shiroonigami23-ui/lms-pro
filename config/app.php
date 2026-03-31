<?php
$config = [
    'app_name' => 'LMS Pro',
    'owner_name' => 'Shirooni23k',
    'owner_email' => 'shiroonigami23@gmail.com',
    'owner_phone' => '+91-7847948216',
    'owner_location' => 'Gwalior, Madhya Pradesh, India',
    'owner_location_url' => 'https://www.google.com/maps/place/Gwalior,+Madhya+Pradesh/',
    'social' => [
        'github' => 'https://github.com/shiroonigami23-ui',
        'leetcode' => 'https://leetcode.com/u/Shirooni23k/',
    ],
    'db' => [
        'host' => 'sql101.infinityfree.com',
        'user' => 'if0_40800486',
        'pass' => '',
        'name' => 'if0_40800486_Library_Management',
    ],
    'mail' => [
        'smtp_user' => '',
        'smtp_pass' => '',
    ],
    'live_url' => 'https://sobran.lovestoblog.com/library/User/index.php',
];

$localOverride = __DIR__ . '/app.local.php';
if (file_exists($localOverride)) {
    $localConfig = require $localOverride;
    if (is_array($localConfig)) {
        $config = array_replace_recursive($config, $localConfig);
    }
}

return $config;

