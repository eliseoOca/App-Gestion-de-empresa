<?php
include 'config.php'; // Conexión a la base de datos

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$num_presupuesto = $_POST['presupuesto'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$precio_unitario = $_POST['unitario'];
$impuesto = $_POST['impuesto'];
$subtotal = $_POST['subtotal'];
$total = $_POST['total'];

// Insertar datos en la base de datos
$sql = "INSERT INTO facturacion (nombre, direccion, telefono, email, num_presupuesto, fecha, descripcion, cantidad, precio_unitario, impuesto, subtotal, total) 
        VALUES ('$nombre', '$direccion', '$telefono', '$email', '$num_presupuesto', '$fecha', '$descripcion', '$cantidad', '$precio_unitario', '$impuesto', '$subtotal', '$total')";

if ($conn->query($sql) === TRUE) {
    // Obtener el ID del nuevo registro
    $id = $conn->insert_id;

    // Preparar la respuesta
    $response = array(
        'status' => 'success',
        'id' => $id,
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
    );
} else {
    $response = array('status' => 'error', 'message' => 'Error: ' . $conn->error);
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($response);
?>
