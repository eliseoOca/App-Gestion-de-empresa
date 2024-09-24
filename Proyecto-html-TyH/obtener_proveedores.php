<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/Menu.css">
  <link rel="stylesheet" href="css/AgendaProve.css">
  <title>Document</title>
  <style>
    .selected {
      background-color: lightblue;
      border: 1px solid blue;
    }
  </style>
</head>

<body>
    
    <div class="tableAgenda table-container">
      <table border="1" id="tablaProveedores">
        <tr>
          <th>Nombre/R.Social</th>
          <th>Cuit</th>
          <th>Tel/Cel</th>
          <th>Mail</th>
          <th>Acciones</th>
        </tr>
        <?php
        include 'config.php';

        $sql = "SELECT id, nombre_o_rsocial, cuit, telefono, mail FROM proveedores ORDER BY id DESC";
        $result = $conn->query($sql);

        $rows = '';
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $rows .= "<tr class='proveedor' data-id='" . $row['id'] . "'>";
            $rows .= "<td>" . htmlspecialchars($row['nombre_o_rsocial']) . "</td>";
            $rows .= "<td>" . htmlspecialchars($row['cuit']) . "</td>";
            $rows .= "<td>" . htmlspecialchars($row['telefono']) . "</td>";
            $rows .= "<td>" . htmlspecialchars($row['mail']) . "</td>";
            $rows .= "<td><button onclick='seleccionarProveedor(" . $row['id'] . ")'>Seleccionar</button></td>";
            $rows .= "</tr>";
          }
        } else {
          $rows .= "<tr><td colspan='5'>No hay proveedores aún.</td></tr>";
        }

        echo $rows;

        $conn->close();
        ?>

      </table>
    </div>
  </div>
  <script>
    let selectedProveedorId = null;

    function seleccionarProveedor(id) {
      // Remover la clase 'selected' de cualquier fila seleccionada previamente
      var selectedRow = document.querySelector('.proveedor.selected');
      if (selectedRow) {
        selectedRow.classList.remove('selected');
      }

      // Añadir la clase 'selected' a la fila seleccionada
      var proveedorRow = document.querySelector('.proveedor[data-id="' + id + '"]');
      if (proveedorRow) {
        proveedorRow.classList.add('selected');
        selectedProveedorId = id; // Guardar el ID del proveedor seleccionado
      }
    }

    document.getElementById("borrarProveedor").addEventListener("click", function () {
      if (selectedProveedorId) {
        if (confirm("¿Estás seguro de que deseas eliminar este proveedor?")) {
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "eliminar_proveedor.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
              alert(xhr.responseText);
              location.reload(); // Recargar la página para reflejar los cambios
            }
          };
          xhr.send("id=" + selectedProveedorId);
        }
      } else {
        alert("Por favor, selecciona un proveedor para eliminar.");
      }
    });

    function seleccionarProveedor(id) {
      // Remover la clase 'selected' de cualquier fila seleccionada previamente
      var selectedRow = document.querySelector('.proveedor.selected');
      if (selectedRow) {
        selectedRow.classList.remove('selected');
      }

      // Añadir la clase 'selected' a la fila seleccionada
      var proveedorRow = document.querySelector('.proveedor[data-id="' + id + '"]');
      if (proveedorRow) {
        proveedorRow.classList.add('selected');
        selectedProveedorId = id; // Guardar el ID del proveedor seleccionado
      }

      // Cargar los datos del proveedor en el formulario
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "obtener_proveedor.php?id=" + id, true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var data = JSON.parse(xhr.responseText);
          if (!data.error) {
            document.getElementById("nombre").value = data.nombre_o_rsocial;
            document.getElementById("cuit").value = data.cuit;
            document.getElementById("telefono").value = data.telefono;
            document.getElementById("mail").value = data.mail;
            document.getElementById("proveedor_id").value = id;
          } else {
            alert(data.error);
          }
        }
      };
      xhr.send();
    }

    document.getElementById("proveedorForm").addEventListener("submit", guardarProveedor);

    function guardarProveedor(event) {
      event.preventDefault(); // Previene el envío del formulario y la recarga de la página

      var id = document.getElementById("proveedor_id").value;
      var nombre = document.getElementById("nombre").value;
      var cuit = document.getElementById("cuit").value;
      var telefono = document.getElementById("telefono").value;
      var mail = document.getElementById("mail").value;

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "guardar_proveedor.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Notificación al usuario
          alert("Proveedor guardado exitosamente");

          // Limpiar el formulario
          document.getElementById("proveedorForm").reset();

          // Actualizar la tabla de proveedores
          actualizarTablaProveedores();
        }
      };

      xhr.send(
        "proveedor_id=" + encodeURIComponent(id) +
        "&nombre=" + encodeURIComponent(nombre) +
        "&cuit=" + encodeURIComponent(cuit) +
        "&telefono=" + encodeURIComponent(telefono) +
        "&mail=" + encodeURIComponent(mail)
      );
    }

    function actualizarTablaProveedores() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "obtener_proveedor.php", true); // Este archivo debería devolver el HTML de la tabla actualizado
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Reemplazar el contenido de la tabla
          document.querySelector("#tablaProveedores tbody").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }




  </script>
</body>

</html>