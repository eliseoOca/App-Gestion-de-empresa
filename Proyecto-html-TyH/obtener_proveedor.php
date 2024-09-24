<?php
include 'config.php'; // Archivo para la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener los datos del proveedor
    $sql = "SELECT nombre_o_rsocial, cuit, telefono, mail FROM proveedores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "No se encontró el proveedor."]);
        }
    } else {
        echo json_encode(["error" => "Error en la consulta: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>