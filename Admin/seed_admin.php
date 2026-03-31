<?php
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);

$email = 'shiroonigami23@gmail.com';
$password = 'shiro';
$name = 'Shiro Admin';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$checkQuery = mysqli_query($connection, "SELECT id FROM admins WHERE email='$email' LIMIT 1");
if (mysqli_num_rows($checkQuery) === 1) {
    mysqli_query($connection, "UPDATE admins SET name='$name', password='$hashedPassword' WHERE email='$email'");
    echo "Admin updated: $email";
} else {
    mysqli_query($connection, "INSERT INTO admins (name, email, password) VALUES ('$name', '$email', '$hashedPassword')");
    echo "Admin created: $email";
}
