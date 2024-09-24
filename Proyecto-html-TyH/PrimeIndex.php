<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/Menu.css" />

  <title>Document</title>
</head>

<body>
  <style>
    /* Estilos generales para hacer el diseño más flexible */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Estilos generales del contenedor del calendario */
    .calendar-container {
      width: 90%;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 2px solid #ddd;
      border-radius: 10px;
      background-color: #f9f9f9;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Estilos del encabezado del calendario */
    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .calendar-header h3 {
      margin: 0;
      font-size: 1.2rem;
    }

    .calendar-header button {
      padding: 5px 10px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .calendar-header button:hover {
      background-color: #0056b3;
    }

    /* Estilos de la cuadrícula del calendario */
    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 5px;
    }

    .calendar div {
      padding: 15px;
      text-align: center;
      background-color: #ffffff;
      border: 1px solid #ddd;
      border-radius: 5px;
      cursor: pointer;
    }

    .calendar div:hover {
      background-color: #f0f0f0;
    }

    /* Estilo para los días marcados */
    .calendar .day-selected {
      background-color: yellow;
      font-weight: bold;
    }

    /* Estilo para los días que no son del mes actual */
    .calendar .inactive {
      color: #ccc;
    }

    /* Día actual */
    .calendar .current-day {
      background-color: yellow;
      border: 2px solid #FFCC00;
      font-weight: bold;
    }

    /* Estilos para el contenedor de la pizarra */
    .container-pizarra-p {
      width: 90%;
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #f0f0f0;
      border: 2px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Estilos para el título de la pizarra */
    .container-pizarra-p h2 {
      text-align: center;
      font-size: 1.5rem;
      color: #333;
      margin-bottom: 20px;
    }

    /* Estilos para el contenedor de las notas */
    #notes {
      max-height: 300px;
      overflow-y: auto;
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ddd;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* Estilos para cada nota individual */
    .note {
      padding: 10px;
      margin-bottom: 10px;

      border: 1px solid #b3dff2;
      border-radius: 5px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /* Estilos para cuando una nota está seleccionada */
    .note.selected {
      background-color: orange;
      color: white;
      /* Color de texto blanco para mejor contraste */
      border: 1px solid #ff8c00;
      /* Borde oscuro para mayor definición */
    }


    .note button {
      padding: 5px 10px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .note button:hover {
      background-color: #0056b3;
    }

    /* Estilos para el textarea */
    #noteInput {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
      font-size: 16px;
    }

    /* Estilos para los botones de agregar y borrar tarea */
    button {
      padding: 10px 15px;
      margin: 5px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }

    button+button {
      background-color: #dc3545;
    }

    button+button:hover {
      background-color: #c82333;
    }

    /* Media queries para adaptarse a pantallas más pequeñas */
    @media (max-width: 768px) {
      .calendar-header h3 {
        font-size: 1rem;
      }

      .calendar-header button {
        padding: 4px 8px;
        font-size: 0.9rem;
      }

      .calendar div {
        padding: 10px;
      }

      .container-pizarra-p {
        padding: 15px;
      }

      .note {
        font-size: 14px;
      }

      #noteInput {
        font-size: 14px;
      }

      button {
        padding: 8px 12px;
        font-size: 14px;
      }
    }

    /* Media queries para pantallas móviles aún más pequeñas */
    @media (max-width: 480px) {
      .calendar-header h3 {
        font-size: 0.9rem;
      }

      .calendar-header button {
        padding: 3px 6px;
        font-size: 0.8rem;
      }

      .calendar div {
        padding: 8px;
      }

      .note {
        font-size: 12px;
      }

      #noteInput {
        font-size: 12px;
      }

      button {
        padding: 6px 10px;
        font-size: 12px;
      }
    }
  </style>

  <div class="container">
    <header>
      <div class="logo">
        <img src="img/Logo 1.jpg" alt="Logo" />
      </div>
      <ul>
        <li><a href="agendaProve.php">Agenda Proveedores</a></li>
        <li><a href="facturacion.php">Mesa de Trabajo</a></li>
        <li><a href="DetalleVenta.php">Detalle venta</a></li>
        <li><a href="Presupuesto.php">Facturaciòn</a></li>
        <li><a href="index.php">Cerrar Sesion</a></li>
      </ul>
      <h2><span id="clock"></span></h2>
    </header>
    <br>
    <div class="container-p">
      <div class="calendar-container">
        <h2>Calendario</h2>
        <div class="calendar-header">
          <button onclick="prevMonth()">Anterior</button>
          <h3 id="monthYear"></h3>
          <button onclick="nextMonth()">Siguiente</button>
        </div>
        <div id="calendar" class="calendar"></div>
      </div>

      <!-- Pizarra de notas -->
      <div class="container-pizarra-p">
        <div class="board">
          <h2>Pizarra de Tareas</h2>

          <!-- Mostrar comentarios aquí -->
          <div id="notes">
            <?php
            include 'config.php'; // Conexión a la base de datos
            
            $sql = "SELECT id, comentario FROM comentarios ORDER BY id DESC"; // Consulta para obtener los comentarios
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Recorrer cada comentario y generar el HTML necesario para mostrarlo
              while ($row = $result->fetch_assoc()) {
                echo "<div class='note' data-id='" . $row['id'] . "'>";
                echo htmlspecialchars($row['comentario']);
                echo " <button onclick='seleccionarTarea(" . $row['id'] . ")'>Seleccionar</button>";
                echo "</div>";
              }
            } else {
              echo "<div class='note'>No hay comentarios aún.</div>"; // Mostrar un mensaje si no hay comentarios
            }

            $conn->close();
            ?>
          </div>

          <!-- Textarea para agregar nuevas tareas -->
          <textarea id="noteInput" rows="4" cols="30" placeholder="Escribe tu tarea aquí..."></textarea><br>
          <button onclick="agregarComentario()">Agregar Tarea</button>
          ----<button onclick="borrarTarea()">Borrar Tarea</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    var selectedTaskId = null; // Variable global para almacenar el ID de la tarea seleccionada

    function agregarComentario() {
      var comentario = document.getElementById("noteInput").value;

      if (comentario.trim() === "") {
        alert("Por favor, escribe un comentario.");
        return;
      }

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "guardar_comentario.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          alert(xhr.responseText);
          document.getElementById("noteInput").value = ""; // Limpiar el textarea
          location.reload(); // Recargar la página para mostrar el nuevo comentario
        }
      };
      xhr.send("comentario=" + encodeURIComponent(comentario));
    }

    function seleccionarTarea(id) {
      // Eliminar la clase 'selected' de cualquier tarea previamente seleccionada
      var selectedNote = document.querySelector('.note.selected');
      if (selectedNote) {
        selectedNote.classList.remove('selected');
      }

      // Añadir la clase 'selected' a la tarea seleccionada
      var note = document.querySelector('.note[data-id="' + id + '"]');
      if (note) {
        note.classList.add('selected');
      }

      // Guardar el ID de la tarea seleccionada
      selectedTaskId = id;
    }

    function borrarTarea() {
      if (selectedTaskId === null) {
        alert("Por favor, selecciona una tarea para borrar.");
        return;
      }

      // Confirmar la eliminación
      if (!confirm("¿Estás seguro de que quieres borrar esta tarea?")) {
        return;
      }

      // Hacer la solicitud AJAX para borrar la tarea
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "borrar_comentario.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          alert(xhr.responseText);
          location.reload(); // Recargar la página para actualizar la lista de tareas
        }
      };
      xhr.send("id=" + encodeURIComponent(selectedTaskId));
    }

    function selectDay(dayElement) {
      // Remover la selección anterior
      const selectedDay = document.querySelector('.calendar .day-selected');
      if (selectedDay) {
        selectedDay.classList.remove('day-selected');
      }

      // Agregar la clase 'day-selected' al día seleccionado
      dayElement.classList.add('day-selected');
    }
  </script>


  <script src="js/reloj.js"></script>
  <script src="js/calendar.js"></script>

</body>

</html>