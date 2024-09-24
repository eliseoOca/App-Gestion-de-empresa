// Función para cargar los comentarios desde la base de datos
function cargarComentarios() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "obtener_comentarios.php", true);
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById("notes").innerHTML = xhr.responseText;
      }
  };
  xhr.send();
}

// Llamar a la función para cargar los comentarios cuando se cargue la página
window.onload = function() {
  cargarComentarios();
};
