document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function darkMode() {

    //Preferencias de sistema
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    
    if(prefiereDarkMode.matches) { // se ponne darkmode auto si lo tenes en tu sistema
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    // Si el usuario cambia a darkmode en sus sistema, que cambie INSTA
    prefiereDarkMode.addEventListener('change', function() { 
        if(prefiereDarkMode.matches) { // se ponne darkmode auto si lo tenes en tu sistema
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    }); // MUY GOD ESTA FUNCION.

    // pero podes seguir usanndo el boton para togglear
    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode'); // le cambia la clase a TODO el body
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() { // al hacer click, la navegacion tiene que pasar de display none a block asi se muestra.
    const navegacion = document.querySelector(".navegacion");

    navegacion.classList.toggle('mostrar'); // hace lo mismo que estos if else
    // if (navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar');
    // } else {
    //     navegacion.classList.add('mostrar');
    // }

}
