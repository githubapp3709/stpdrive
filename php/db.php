<?php
$localhost = "localhost";
$username = "root";
$password = "";
$database = "stpdrive";

$db = new mysqli($localhost, $username, $password, $database);

if ($db->connect_error) {
    die("connection not established");
}
