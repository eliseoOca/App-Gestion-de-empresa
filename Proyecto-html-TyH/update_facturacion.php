<?php
include 'config.php'; // Conexión a la base de datos

// Verificar si se han enviado los datos esperados
$id = isset($_POST['id']) ? $_POST['id'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$num_presupuesto = isset($_POST['presupuesto']) ? $_POST['presupuesto'] : null;
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : null;
$precio_unitario = isset($_POST['unitario']) ? $_POST['unitario'] : null;
$impuesto = isset($_POST['impuesto']) ? $_POST['impuesto'] : null;
$subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : null;
$total = isset($_POST['total']) ? $_POST['total'] : null;

if ($id !== null) {
  $sql = "UPDATE facturacion SET 
          nombre=?, 
          direccion=?, 
          telefono=?, 
          email=?, 
          num_presupuesto=?, 
          fecha=?, 
          descripcion=?, 
          cantidad=?, 
          precio_unitario=?, 
          impuesto=?, 
          subtotal=?, 
          total=? 
          WHERE id=?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param(
    'ssssssssssssi',
    $nombre,
    $direccion,
    $telefono,
    $email,
    $num_presupuesto,
    $fecha,
    $descripcion,
    $cantidad,
    $precio_unitario,
    $impuesto,
    $subtotal,
    $total,
    $id
  );

  if ($stmt->execute()) {
    echo json_encode([
      'nombre' => $nombre,
      'direccion' => $direccion,
      'telefono' => $telefono,
      'email' => $email,
      'num_presupuesto' => $num_presupuesto,
      'fecha' => $fecha,
      'descripcion' => $descripcion,
      'cantidad' => $cantidad,
      'precio_unitario' => $precio_unitario,
      'impuesto' => $impuesto,
      'subtotal' => $subtotal,
      'total' => $total
    ]);
  } else {
    echo json_encode(['error' => 'Error al actualizar el registro']);
  }

  $stmt->close();
} else {
  echo json_encode(['error' => 'ID no proporcionado']);
}
$conn->close();



?>