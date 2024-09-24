document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario
    // Redirige al usuario a la página deseada
    window.location.href = 'PrimeIndex.html'; // Cambia 'pagina-destino.html' por la URL a la que quieres redirigir
});