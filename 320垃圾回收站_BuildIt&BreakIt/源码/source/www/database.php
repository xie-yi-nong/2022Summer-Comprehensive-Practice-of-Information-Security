<?php

$host = "mysql";
$dbname = "garbage_collection";
$username = "garbage_collection";
$password = "garbage_collection";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
