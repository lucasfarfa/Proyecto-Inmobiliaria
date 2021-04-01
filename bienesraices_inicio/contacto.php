<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpeg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen formulario">
    </picture>

    <h2>Llene el formulario de contacto.</h2>

    <form class="formulario">
        <fieldset>
            <!-- agrupar ennntradas relacionandas enn unn form-->
            <legend>Información personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" placeholder="Tu nombre">

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Tu email">

            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" placeholder="Tu télefono">

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o compra:</label>
            <select id="opciones">
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" id="presupuesto" placeholder="Tu precio o presupuesto">
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">
                <!-- el name debe ser igual para usarlos en php-->
                <label for="contactar-email">Email</label>
                <input name="contacto" type="radio" value="email" id="contactar-email">
            </div>

            <p>Si eligió teléfono, elija la fecha y la hora</p>

            <label for="fecha">fecha</label>
            <input type="date" id="fecha">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00">
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>