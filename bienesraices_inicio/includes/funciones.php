<?php
require 'app.php';

// basicamente para non poner los includes en las paginas porque queda feo.
function incluirTemplate(string $nombre, bool $inicio = false, bool $titulo = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(): bool
{
    session_start(); #asi solo el administrador puede ingresar a esta pagina
    $auth = $_SESSION['login'];
    if($auth) {
        return true;
    }
    return false;
}
