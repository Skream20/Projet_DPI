<?php
function connexion()
{
    $host = "localhost";
    $user = "root"; 
    $password = "password"; 
    $dbname = "dpi";
    $port = 3308;

    $mysqli = new mysqli($host, $user, $password, $dbname, $port);
    if ($mysqli->connect_errno) {
        echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        return ($mysqli->connect_errno);
    }
    return $mysqli;
}
