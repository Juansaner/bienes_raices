document.addEventListener('DOMContentLoaded', function() {
    
    eventListeners();
    darkMode();
});

function darkMode() {

    /** Leer preferencias del sistema */
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if(prefiereDarkMode.matches){
        document.body.classList.add('darkMode');
    } else {
        document.body.classList.remove('darkMode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('darkMode');
        } else {
            document.body.classList.remove('darkMode');
        }
    });

    const botonDarkMode = document.querySelector('.navegacion-dark-mode');
    /** Activar o desactivar dark mode */
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('darkMode');
        /** Verifica si el body contiene la clase darkMode para posteriormente cambiar el texto del botón */
        if(document.body.classList.contains('darkMode')){
            document.getElementById('dark-mode-texto').innerText = 'Modo luz';
        } else  {
            document.getElementById('dark-mode-texto').innerText = 'Modo oscuro';
        }
    })
}

function eventListeners() {
    const mobileMenu = document.querySelector('.menu-mobile');
    const closeMenu = document.querySelector('.close-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
    closeMenu.addEventListener('click', cerrar);
}

/** Agrega clase mostrar para desplegar menu hamburguesa */
function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar'); 
}
/** Cerrar menu hamburguesa */
function cerrar() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.remove('mostrar');
}