
// Función para actualizar el reloj
function updateClock() {
    const options = { timeZone: 'America/Argentina/Buenos_Aires', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    const now = new Date().toLocaleTimeString('es-AR', options);
    document.getElementById('clock').innerText = now;
  }
  
  setInterval(updateClock, 1000);
  
 
  