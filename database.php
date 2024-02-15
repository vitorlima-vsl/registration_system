<?php
$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno)
{
    //usar ou nao usar acentos? hm, fica ai o pensamento para eu do futuro
    die("erro de conexão: " . $mysqli->connect_error);
}

return $mysqli;