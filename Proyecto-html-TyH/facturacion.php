<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/Menu.css" />
  <link rel="stylesheet" href="css/AgendaProve.css" />
  <!--link rel="stylesheet" href="css/calculadora.css" />-->
  < <title>Document</title>
    <style>
      tr.selected {
        background-color: lightblue;
        color: white;
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
      <li><a href="agendaProve.php">Agenda Proveedores</a></li>
      <li><a href="DetalleVenta.php">Detalle venta</a></li>
      <li><a href="Presupuesto.php">Facturaciòn</a></li>
      <li><a href="index.php">Cerrar Sesion</a></li>
    </ul>
    <h2><span id="clock"></span></h2>
  </header>
  <h1 class="titulo-prove">Escritorio de Presupuesto</h1>
  <br />
  <div class="container">
    <div class="formAgenda">
      <form id="facturacionForm" method="post" action="update_facturacion.php">
        <input type="hidden" id="id" name="id" />
        <h2>Detalles Del Cliente</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" size="20" /><br />

        <label for="direccion">Direccion:</label>
        <input type="text" id="direccion" name="direccion" size="20" /><br />

        <label for="telefono">Telefono:</label>
        <input type="number" id="telefono" name="telefono" size="20" /><br />

        <label for="mail">Mail:</label>
        <input type="email" id="mail" name="email" size="20" /><br />

        <h2>Detalles Del Presupuesto</h2>

        <label for="presupuesto">Num.Presupuesto:</label>
        <input type="number" id="presupuesto" name="presupuesto" size="20" /><br />

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" size="20" /><br />

        <h2>Datos de Venta</h2>
        <label for="descripcion">Descripcion:</label>
        <input type="text" id="descripcion" name="descripcion" size="20" /><br />

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" size="20" /><br />

        <label for="unitario">Precio unitario:</label>
        <input type="number" id="unitario" name="unitario" size="20" /><br />

        <label for="impuesto">Impuesto:</label>
        <input type="text" id="impuesto" name="impuesto" size="20" /><br />

        <label for="subtotal">Subtotal:</label>
        <input type="number" id="subtotal" name="subtotal" size="20" /><br />

        <label for="total">Total:</label>
        <input type="number" id="total" name="total" size="20" /><br />

        <input type="submit" class="fireButton" value="Enviar" id="enviarBtn" />
        <input type="submit" class="fireButton" value="Guardar" id="guardarBtn" />
        <input type="submit" class="fireButton" value="Borrar" id="borrarBtn" />

      </form>
    </div>
    <div class="tableAgenda table-container">
      <table border="1">
        <thead>
          <t>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Mail</th>
            <th>Num.Presupuesto</th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Impuesto</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          <?php
          include 'config.php'; // Conexión a la base de datos
          
          $sql = "SELECT * FROM facturacion ORDER BY id DESC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr data-id='" . $row['id'] . "'>";
              echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
              echo "<td>" . htmlspecialchars($row['direccion']) . "</td>";
              echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
              echo "<td>" . htmlspecialchars($row['email']) . "</td>";
              echo "<td>" . htmlspecialchars($row['num_presupuesto']) . "</td>";
              echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
              echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
              echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
              echo "<td>" . htmlspecialchars($row['precio_unitario']) . "</td>";
              echo "<td>" . htmlspecialchars($row['impuesto']) . "</td>";
              echo "<td>" . htmlspecialchars($row['subtotal']) . "</td>";
              echo "<td>" . htmlspecialchars($row['total']) . "</td>";
              echo "<td><button class='select-button'>Seleccionar</button></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='13'>No hay registros en la tabla de facturación.</td></tr>";
          }

          $conn->close();


          ?>

        </tbody>
      </table>
    </div>

  </div>
  <br />
  <!--<div class="calculator body-cal">
    <input type="text" class="calculator-screen" value="" disabled />
    <div class="calculator-keys">
      <button type="button" class="operator estilo" value="+">+</button>
      <button type="button" class="operator estilo" value="-">-</button>
      <button type="button" class="operator estilo" value="*">&times;</button>
      <button type="button" class="operator estilo" value="/">&divide;</button>
      <button type="button" class="operator estilo" value="%">%</button>

      <button type="button" class="estilo" value="7">7</button>
      <button type="button" class="estilo" value="8">8</button>
      <button type="button" class="estilo" value="9">9</button>

      <button type="button" class="estilo" value="4">4</button>
      <button type="button" class="estilo" value="5">5</button>
      <button type="button" class="estilo" value="6">6</button>

      <button type="button" class="estilo" value="1">1</button>
      <button type="button" class="estilo" value="2">2</button>
      <button type="button" class="estilo" value="3">3</button>

      <button type="button" class="estilo" value="0">0</button>
      <button type="button" class="estilo" value=".">.</button>
      <button type="button" class="all-clear" value="all-clear">AC</button>

      <button type="button" class="equal-sign operator" value="=">=</button>
    </div>
  </div>-->

  <script>
    document.getElementById('enviarBtn').addEventListener('click', function (event) {
      event.preventDefault(); // Previene el envío del formulario por defecto

      // Obtener los datos del formulario
      const formData = new FormData(document.getElementById('facturacionForm'));

      // Crear una solicitud AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "insert_facturacion.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          try {
            const response = JSON.parse(xhr.responseText);

            if (response.status === 'success') {
              alert('Datos insertados correctamente');

              // Limpiar los campos del formulario
              document.getElementById('facturacionForm').reset();

              // Crear una nueva fila en la tabla
              var tableBody = document.querySelector('.tableAgenda tbody');
              var newRow = document.createElement('tr');
              newRow.setAttribute('data-id', response.id);
              newRow.innerHTML = `
                        <td>${response.nombre}</td>
                        <td>${response.direccion}</td>
                        <td>${response.telefono}</td>
                        <td>${response.email}</td>
                        <td>${response.num_presupuesto}</td>
                        <td>${response.fecha}</td>
                        <td>${response.descripcion}</td>
                        <td>${response.cantidad}</td>
                        <td>${response.precio_unitario}</td>
                        <td>${response.impuesto}</td>
                        <td>${response.subtotal}</td>
                        <td>${response.total}</td>
                        <td><button class='select-button'>Seleccionar</button></td>
                    `;
              tableBody.insertBefore(newRow, tableBody.firstChild); // Insertar la nueva fila al principio de la tabla
            } else {
              alert('Error: ' + response.message);
            }
          } catch (error) {
            console.error('Error al procesar la respuesta del servidor:', error);
          }
        }
      };

      // Convertir los datos del formulario en una cadena de consulta
      var data = new URLSearchParams(formData).toString();

      // Enviar los datos
      xhr.send(data);
    });




    document.querySelectorAll('.select-button').forEach(button => {
      button.addEventListener('click', function () {
        // Remover la clase 'selected' de cualquier fila previamente seleccionada y restaurar el color original
        document.querySelectorAll('tr').forEach(row => {
          row.classList.remove('selected');
          row.style.backgroundColor = ''; // Restaurar el color original
        });

        // Agregar la clase 'selected' a la fila actual y cambiar el color de fondo
        const row = this.closest('tr');
        row.classList.add('selected');
        row.style.backgroundColor = 'lightblue';

        // Obtener el ID de la fila (debe estar en un campo oculto o similar)
        const id = row.dataset.id;
        document.getElementById('id').value = id; // Asignar el ID al campo oculto

        // Enviar una solicitud AJAX para obtener los datos de la fila desde la base de datos
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_facturacion.php?id=" + id, true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);

            // Rellenar el formulario con los datos obtenidos
            document.getElementById('nombre').value = data.nombre;
            document.getElementById('direccion').value = data.direccion;
            document.getElementById('telefono').value = data.telefono;
            document.getElementById('mail').value = data.email;
            document.getElementById('presupuesto').value = data.num_presupuesto;
            document.getElementById('fecha').value = data.fecha;
            document.getElementById('descripcion').value = data.descripcion;
            document.getElementById('cantidad').value = data.cantidad;
            document.getElementById('unitario').value = data.precio_unitario;
            document.getElementById('impuesto').value = data.impuesto;
            document.getElementById('subtotal').value = data.subtotal;
            document.getElementById('total').value = data.total;
          }
        };
        xhr.send();
      });
    });

    document.getElementById('guardarBtn').addEventListener('click', function (event) {
      event.preventDefault(); // Previene el envío del formulario por defecto

      // Obtener los datos del formulario
      const formData = new FormData(document.getElementById('facturacionForm'));

      // Enviar los datos mediante AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "update_facturacion.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          try {
            const response = JSON.parse(xhr.responseText);

            // Actualizar la tabla con los nuevos datos
            const selectedRow = document.querySelector('tr.selected');
            if (selectedRow) {
              selectedRow.cells[0].textContent = response.nombre;
              selectedRow.cells[1].textContent = response.direccion;
              selectedRow.cells[2].textContent = response.telefono;
              selectedRow.cells[3].textContent = response.email;
              selectedRow.cells[4].textContent = response.num_presupuesto;
              selectedRow.cells[5].textContent = response.fecha;
              selectedRow.cells[6].textContent = response.descripcion;
              selectedRow.cells[7].textContent = response.cantidad;
              selectedRow.cells[8].textContent = response.precio_unitario;
              selectedRow.cells[9].textContent = response.impuesto;
              selectedRow.cells[10].textContent = response.subtotal;
              selectedRow.cells[11].textContent = response.total;
            }

            // Limpiar los campos del formulario
            document.getElementById('facturacionForm').reset();

            // Eliminar la selección de la fila
            if (selectedRow) {
              selectedRow.classList.remove('selected');
              selectedRow.style.backgroundColor = ''; // Restaurar el color original
            }
          } catch (error) {
            console.error('Error al procesar la respuesta del servidor:', error);
          }
        }
      };
      xhr.send(formData);
    });


    document.getElementById('borrarBtn').addEventListener('click', function (event) {
      event.preventDefault(); // Previene el envío del formulario por defecto

      // Obtener el ID de la fila seleccionada
      const id = document.getElementById('id').value;

      if (id) {
        if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
          // Enviar solicitud AJAX para eliminar la fila
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "delete_facturacion.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
              try {
                const response = JSON.parse(xhr.responseText);

                if (response.status === 'success') {
                  // Eliminar la fila de la tabla
                  const selectedRow = document.querySelector('tr.selected');
                  if (selectedRow) {
                    selectedRow.remove();
                  }

                  // Limpiar los campos del formulario
                  document.getElementById('facturacionForm').reset();
                } else {
                  alert('Error: ' + response.message);
                }
              } catch (error) {
                console.error('Error al procesar la respuesta del servidor:', error);
              }
            }
          };
          xhr.send("id=" + encodeURIComponent(id));
        }
      } else {
        alert('Selecciona una fila para borrar.');
      }
    });



  </script>


</body>

<script src="js/reloj.js"></script>


</html>