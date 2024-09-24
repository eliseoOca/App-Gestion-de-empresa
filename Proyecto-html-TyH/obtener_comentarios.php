<?php
include 'config.php'; // Asegúrate de tener la configuración de la base de datos

$sql = "SELECT comentario FROM comentarios ORDER BY id DESC"; // Consulta para obtener los comentarios
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Recorrer cada comentario y generar el HTML necesario para mostrarlo
    while($row = $result->fetch_assoc()) {
        echo "<div class='note'>" . htmlspecialchars($row['comentario']) . "</div>";
    }
} else {
    echo "No hay comentarios aún."; // Mostrar un mensaje si no hay comentarios
}

$conn->close();
?>

