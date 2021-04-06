<?php  // importante no subir ester archivo produccion 

// Importar conexion
require 'includes/config/database.php';
$db =  conectarDB();

// Crear email y password
$email = "correo@correo.com";
$password = "123456";

// Hasheo password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Query para crear el usuario
$query = " INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}'); ";
//echo $query;

mysqli_query($db,$query);
// Agregarlo a la base de datos
