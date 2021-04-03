<?php

// Conectarse a DB

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost','root','root','bienes_raices');
    $db-> set_charset("utf8"); // para no tener problemas. SUPER IMPORTANTE

    if (!$db) {
        echo 'Failed trying to connect to database';
        exit;
    }

    return $db;
}