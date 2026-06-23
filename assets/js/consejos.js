// Recuperamos los datos guardados, o iniciamos en 0 si es la primera vez
let agua = parseInt(localStorage.getItem("smarttime_agua")) || 0;
let pausas = parseInt(localStorage.getItem("smarttime_pausas")) || 0;

function actualizarContadores() {
    document.getElementById("contador-agua").textContent = agua;
    document.getElementById("contador-pausas").textContent = pausas;
    
    // Guardamos permanentemente en el navegador
    localStorage.setItem("smarttime_agua", agua);
    localStorage.setItem("smarttime_pausas", pausas);
}

function sumarAgua() {
    if (agua < 8) {
        agua++;
        actualizarContadores();
    }
}

function restarAgua() {
    if (agua > 0) {
        agua--;
        actualizarContadores();
    }
}

function sumarPausa() {
    if (pausas < 3) {
        pausas++;
        actualizarContadores();
    }
}

function restarPausa() {
    if (pausas > 0) {
        pausas--;
        actualizarContadores();
    }
}

// Inicializar la pantalla con los valores guardados
actualizarContadores();