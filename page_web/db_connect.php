<?php
function connexion()
{
    $host = "localhost";
    $user = "root";
    $password = "Iroise29";
    $dbname = "DPI";
    $port = "3306";

    $mysqli = new mysqli($host, $user, $password, $dbname, $port);
    if ($mysqli->connect_errno) {
        echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        return ($mysqli->connect_errno);
    }
    return $mysqli;
}