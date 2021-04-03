<?php

// Conectarse a DB

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost','root','root','bienes_raices');

    if (!$db) {
        echo 'Failed trying to connect to database';
        exit;
    }

    return $db;
}