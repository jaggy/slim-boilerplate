<?php

$host = '';
$username = '';
$password = '';
$database = '';

$connection = "mysql:host={$host};dbname={$database}";

ORM::configure(array(
    'connection_string' => $connection,
    'username'          => $username,
    'password'          => $password
));