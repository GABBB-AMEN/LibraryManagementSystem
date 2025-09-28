<?php
$DB_HOST = 'mysql-db';
$DB_USER = 'root';
$DB_PASS = 'rootpassword';   // must be the same password you use in phpMyAdmin
$DB_NAME = 'Library_DB';     // since that’s the exact name you created

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    die("Failed to connect: " . $mysqli->connect_error);
}

?>
