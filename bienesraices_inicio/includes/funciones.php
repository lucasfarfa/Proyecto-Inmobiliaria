<?php
require 'app.php';

// basicamente para non poner los includes en las paginas porque queda feo.
function incluirTemplate(string $nombre, bool $inicio = false, bool $titulo = false) {
    include TEMPLATES_URL . "/${nombre}.php";
}
