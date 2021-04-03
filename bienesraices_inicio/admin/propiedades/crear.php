<?php
// Base de datos
require '../../includes/config/database.php';
$db =  conectarDB(); // llamo la db aqui porque es donde la voy a usar para poder guardar los datos del form

// Array con mensajes de errores para validacion de formulario
$errores = [];

/** Esto de inicializarlo en string vacio es para mantener el valor en de un campo en caso de error.
*  Complementa con value="<?php echo $variable; ?> dentro de cada input **/
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

// Ejecuta codigo despues de que el usuario envie el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // con eso me traigo a PHP lo que el usaurio escriba.
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedor'];

    // valido que este todo cargado.
    // la sintaxis $errores[] = va agregando al final del array
    if (!$titulo) { //si titulo esta vacio...
        $errores[] = "Debes añadir un titulo";
    }
    if (!$precio) { //si precio esta vacio...
        $errores[] = "El precio es obligatorio";
    }
    if (strlen($descripcion) < 50) { // Valido descripcion
        $errores[] = "La descripcion es obligatoria y debe ser de minimo 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Numero de habitaciones obligatorio";
    }
    if (!$wc) {
        $errores[] = "Numero de baños obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "Numero de estacionamiento obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }

    // echo '<pre>';
    // var_dump($errores);
    // echo '</pre>';

    // Revisar que el array de errores este vacio y ahi correr el $query
    if (empty($errores)) {
        // Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId')"; // codigo SQL -- Ingreso a la DB los datos del form. -- $ variables de donnde toma los valores (VALUE)
        //echo $query ; deberia imprimir lo ingresado por el user en codigo SQL.

        $resultado = mysqli_query($db, $query); //creo var $resultado para mandar los datos del form a la db.

        if ($resultado) { // esto lo use para ver en la pagina si se cargaba o nno la data a la database.
            echo 'insertado correctamente';
        } else {
            echo 'ta rancio';
        }
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : // imprime cada error (ej falta titulo) 
    ?>
        <div class="alerta error">
            <!-- le asigno clase para que no quede feo en el html -->
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png"> <!-- file permite subir archivo -->

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea> <!-- text area NO USA value -->
        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">estacionamiento:</label>
            <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="" selected>--Seleccione--</option>
                <option value="1">Lucas</option>
                <option value="2">Juan</option>
                <option value="3">Karen</option>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>

<?php incluirTemplate('footer'); ?>