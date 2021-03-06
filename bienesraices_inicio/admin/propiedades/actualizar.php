<!-- PARTE U del CRUD -->
<?php // VID 318 - 321

require '../../includes/funciones.php';
$auth = estaAutenticado();

if(!$auth) { #si no tengo acceso me redirecciona a otra pagina
    header('Location: /');
}

// Validar por id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

// Base de datos
require '../../includes/config/database.php';
$db =  conectarDB(); // llamo la db aqui porque es donde la voy a usar para poder guardar los datos del form

// Obtener los datos de la propiedad con el id
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado); // me guardo la propiedad



// Consultar DB para obtener los vendedores y asi mostrarlos en el form.
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Array con mensajes de errores para validacion de formulario
$errores = [];

// Inicializo los valores del form con los de la database
$titulo = $propiedad["titulo"];
$precio = $propiedad["precio"];
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$vendedorId = $propiedad["vendedorId"];
$imagenPropiedad = $propiedad["imagen"];

// La imagen no se suele rellenar

// Ejecuta codigo despues de que el usuario envie el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d'); //guarda en la db la fecha de creacion nde la nueva propiedad
    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    if (!$titulo) { //si titulo esta vacio...
        $errores[] = "Debes a??adir un titulo";
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
        $errores[] = "Numero de ba??os obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "Numero de estacionamiento obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }


    // Validar imagen por tamano
    $medida = 1000 * 1000; // max 1mb
    if ($imagen['size'] > $medida) {
        $errores[] = ' la imagen es muy pesada';
    }


    // Revisar que el array de errores este vacio y ahi correr el $query
    if (empty($errores)) {

        // Crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) { // si no existe la carpeta nueva, la crea. sino no pasa nada
            mkdir($carpetaImagenes); // crea directorio
        }

        $nombreImagen = '';

        // Si hay nueva imagen que borre la vieja de la carpeta imgs
        if ($imagen['name']) {

            // Elimino imagn previa
            unlink($carpetaImagenes . $propiedad['imagen'] . '.jpg'); // unlink elimina archivos
            // Generar nombre unico
            $nombreImagen = md5(uniqid(rand(), true));

            // Subir imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen . '.jpg');
        } else {
            // mantiene la imagen previa si esta no se modifica
            $nombreImagen = $propiedad['imagen'];
        }

       

        // Actualizo
        $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id} ";

        // siempre comprobar los querys antes de ejecutar en el codigo ->    echo $query;

        $resultado = mysqli_query($db, $query); //creo var $resultado para mandar los datos del form a la db.

        // Redirecciono al usuario una vez que mande bien el form
        if ($resultado) { //asi no meten datos duplicados los locos
            header("Location: /admin?resultado=2"); // sirver para redireccionar al user
        }
    }
}


incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : // imprime cada error (ej falta titulo) 
    ?>
        <div class="alerta error">
            <!-- le asigno clase para que no quede feo en el html -->
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" moodlemate@cbc.uba.ar enctype="multipart/form-data">
        <!-- el multipart es necesario para la subida de archivos -->
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen"> <!-- file permite subir archivo -->

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>.jpg" class="imagen-small">

            <label for="descripcion">Descripci??n:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea> <!-- text area NO USA value -->
        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Ba??os:</label>
            <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">estacionamiento:</label>
            <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="" selected>--Seleccione--</option>

                <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
                    <!-- nos trae cada vendedor con nombre y apellido -->
                    <!-- lo de selected es para que guarde el valor previamente cargado -->
                    <option <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"> <?php echo ($row['nombre'] . " " . $row['apellido']); ?> </option>
                <?php endwhile; ?>

            </select>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>

</main>

<?php incluirTemplate('footer'); ?>