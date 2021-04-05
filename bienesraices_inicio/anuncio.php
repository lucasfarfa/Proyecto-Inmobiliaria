<?php
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) header('Location: /');

// Importar db
require 'includes/config/database.php';

$db = conectarDB();

// Consultar
$query = "SELECT * FROM propiedades WHERE id = ${id}";

// Obtener resultados
$resultado = mysqli_query($db, $query);
if($resultado->num_rows === 0) {
    // si no existe el id redirecciono
    header('Location: /');
}

$propiedad = mysqli_fetch_assoc($resultado);


require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>


    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen'] . '.jpg'; ?>" alt="destacada">


    <div class="resumen-propiedad">
        <p class="precio">U$D <?php echo $propiedad['precio']; ?></p>
        <ul class="iconos-caracteristicas icon-center">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad['descripcion']; ?></p>
    </div>

</main>

<?php
mysqli_close($db);
incluirTemplate('footer');
?>