<?php
include 'config.php'; // Archivo de conexión a la base de datos

// Consultar todos los datos de la tabla
$sql = "SELECT * FROM detalles_de_las_ventas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/DatalleVenta.css" />
  <link rel="stylesheet" href="css/AgendaProve.css" />
  <link rel="stylesheet" href="css/Menu.css" />
  <title>Document</title>
  <style>
    /* Agrega este estilo para pintar la fila seleccionada */
    .selected {
      background-color: lightblue;
    }

    .styled-button {
      background-color: #d9534f;
      color: white;
      width: 150px;
      /* Ancho fijo */
      height: 50px;
      /* Alto fijo */
      font-size: 16px;
      /* Tamaño de la fuente */
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }


    .styled-button:hover {
      background-color: #770d0a;
      /* Color de fondo al pasar el ratón */
      transform: scale(1.05);
      /* Agrandar un poco el botón */
    }

    .styled-button:active {
      background-color: #3e8e41;
      /* Color de fondo cuando se presiona */
      transform: scale(0.98);
      /* Achicar un poco el botón al hacer clic */
    }
  </style>
</head>

<body>
  <header>
    <div class="logo">
      <img src="img/Logo 1.jpg" alt="Logo" />
    </div>
    <ul>
      <li><a href="PrimeIndex.php">Inicio</a></li>
      <li><a href="facturacion.php">Mesa de Trabajo</a></li>
      <li><a href="agendaProve.php">Agenda Proveedores</a></li>
      <li><a href="Presupuesto.php">Facturaciòn</a></li>
      <li><a href="index.php">Cerrar Sesion</a></li>
    </ul>
    <h2><span id="clock"></span></h2>
  </header>
  <h1 class="titulo-prove">Detalle de las Ventas</h1>
  <br>
  <br />
  <div class="containerVenta">
    <div class="formVenta">
      <form id="ventaForm" method="post">
        <input type="hidden" id="formId" name="id" />
        <label for="cliente">Cliente:</label>
        <input type="text" id="cliente" name="cliente" size="20" /><br />

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" size="20" /><br />

        <label for="detalle">Detalle:</label>
        <input type="text" id="detalle" name="detalle" size="20" /><br />

        <label for="pc">Precio Compra:</label>
        <input type="number" id="pc" name="pc" size="20" /><br />

        <label for="pv">Precio Venta:</label>
        <input type="number" id="pv" name="pv" size="20" /><br />

        <input type="button" id="insertButton" class="fireButton" value="Enviar" />
        <button type="button" id="deleteButton" class="fireButton deleteButton">Eliminar</button>
        <input type="button" id="updateButton" class="fireButton" value="Guardar" />
      </form>
    </div>
    <div class="tableVenta table-containerVenta">
      <table border="1">
        <tr>
          <th>Cliente</th>
          <th>Cantidad</th>
          <th>Detalle</th>
          <th>Pre.Compra</th>
          <th>Pre.Venta</th>
          <th>Acciones</th>
        </tr>
        <?php
        // Mostrar los datos de la tabla
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr id='row_{$row['id']}'>";
            echo "<td>{$row['cliente']}</td>";
            echo "<td>{$row['cantidad']}</td>";
            echo "<td>{$row['detalle']}</td>";
            echo "<td>\${$row['precio_compra']}</td>";
            echo "<td>\${$row['precio_venta']}</td>";
            echo "<td><button class='select' data-row-id='{$row['id']}' data-cliente='{$row['cliente']}' data-cantidad='{$row['cantidad']}' data-detalle='{$row['detalle']}' data-precio-compra='{$row['precio_compra']}' data-precio-venta='{$row['precio_venta']}'>Seleccionar</button></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No se encontraron datos</td></tr>";
        }
        // Cerrar la conexión
        $conn->close();
        ?>
      </table>
      <form action="generar_pdf.php" method="post">
        <button type="submit" class="styled-button">Generar PDF</button>
      </form>



    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        let selectedRowId = null; // Variable para almacenar el ID de la fila seleccionada

        // Manejar el clic en el botón Seleccionar
        document.querySelectorAll('.select').forEach(button => {
          button.addEventListener('click', function () {
            // Obtener el ID de la fila
            const rowId = this.getAttribute('data-row-id');

            // Eliminar la clase 'selected' de todas las filas
            document.querySelectorAll('tr').forEach(row => row.classList.remove('selected'));

            // Añadir la clase 'selected' a la fila correspondiente
            document.getElementById('row_' + rowId).classList.add('selected');

            // Actualizar los campos del formulario con los datos de la fila seleccionada
            document.getElementById('cliente').value = this.getAttribute('data-cliente');
            document.getElementById('cantidad').value = this.getAttribute('data-cantidad');
            document.getElementById('detalle').value = this.getAttribute('data-detalle');
            document.getElementById('pc').value = this.getAttribute('data-precio-compra');
            document.getElementById('pv').value = this.getAttribute('data-precio-venta');

            // Agregar el ID de la fila al campo oculto del formulario
            document.getElementById('formId').value = rowId;

            // Guardar el ID de la fila seleccionada
            selectedRowId = rowId;
          });
        });

        // Manejar el clic en el botón Guardar (actualizar)
        document.getElementById('updateButton').addEventListener('click', function () {
          if (selectedRowId) {
            // Enviar los datos del formulario para actualizar la fila seleccionada
            fetch('update_detalles_ventas.php', {
              method: 'POST',
              body: new FormData(document.getElementById('ventaForm')),
            })
              .then(response => response.text())
              .then(data => {
                if (data.trim() === 'success') {
                  // Actualizar la fila en la tabla en el navegador
                  const row = document.getElementById('row_' + selectedRowId);
                  row.querySelector('td:nth-child(1)').textContent = document.getElementById('cliente').value;
                  row.querySelector('td:nth-child(2)').textContent = document.getElementById('cantidad').value;
                  row.querySelector('td:nth-child(3)').textContent = document.getElementById('detalle').value;
                  row.querySelector('td:nth-child(4)').textContent = `$${document.getElementById('pc').value}`;
                  row.querySelector('td:nth-child(5)').textContent = `$${document.getElementById('pv').value}`;

                  // Limpiar los campos del formulario
                  document.getElementById('ventaForm').reset();
                  selectedRowId = null;
                } else {
                  alert('Error al actualizar la fila.');
                }
              });
          } else {
            alert('Por favor, selecciona una fila para actualizar.');
          }
        });

        // Manejar el clic en el botón Eliminar
        document.getElementById('deleteButton').addEventListener('click', function () {
          if (selectedRowId) {
            // Enviar solicitud para eliminar la fila seleccionada
            fetch(`delete_detalle_venta.php?id=${selectedRowId}`, {
              method: 'GET',
            })
              .then(response => response.text())
              .then(data => {
                if (data.trim() === 'success') {
                  // Eliminar la fila de la tabla en el navegador
                  document.getElementById('row_' + selectedRowId).remove();
                  // Limpiar los campos del formulario
                  document.getElementById('ventaForm').reset();
                  selectedRowId = null;
                } else {
                  alert('Error al eliminar la fila.');
                }
              });
          } else {
            alert('Por favor, selecciona una fila primero.');
          }
        });

        // Manejar el clic en el botón Enviar (insertar)
        document.getElementById('insertButton').addEventListener('click', function () {
          // Enviar los datos del formulario para insertar una nueva fila
          fetch('insert_detalles_ventas.php', {
            method: 'POST',
            body: new FormData(document.getElementById('ventaForm')),
          })
            .then(response => response.text())
            .then(data => {
              if (data.trim() === 'success') {
                // Recargar la página para mostrar la nueva fila en la tabla
                location.reload();
              } else {
                alert('Error al insertar la nueva fila.');
              }
            });
        });
      });
    </script>
    <script src="js/reloj.js"></script>
</body>

</html>