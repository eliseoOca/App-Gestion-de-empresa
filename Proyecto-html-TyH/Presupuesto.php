<?php
// Paso 3: Código PHP para buscar al cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "tyh");

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para buscar al cliente
    $sql = "SELECT * FROM facturacion WHERE nombre LIKE '%$search%' OR email LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Asignar los valores a las variables
        $nombre = $row['nombre'];
        $direccion = $row['direccion'];
        $telefono = $row['telefono'];
        $email = $row['email'];
        $num_presupuesto = $row['num_presupuesto'];
        $fecha = $row['fecha'];
        $descripcion = $row['descripcion'];
        $cantidad = $row['cantidad'];
        $precio_unitario = $row['precio_unitario'];
        $impuesto = $row['impuesto'];
        $subtotal = $row['subtotal'];
        $total = $row['total'];
    } else {
        echo "No se encontró ningún cliente con esos datos.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Presupuesto.css">
    <link rel="stylesheet" href="css/barraabajo.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <title>Facturación</title>
</head>

<body>
    <style>
        div.header-container {
            background-color: #f5dd05;
            padding: 20px;
            /* Ajusta el padding según sea necesario */
            text-align: center;
            /* Centra la imagen horizontalmente */
        }

        .invoice {
            background-color: rgb(223 224 222);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .thank-you-message {
            text-align: center;
            /* Centra el texto */
            font-size: 1.2rem;
            /* Tamaño de fuente un poco más grande */
            color: #333;
            /* Un color de texto oscuro y elegante */
            font-family: 'Arial', sans-serif;
            /* Fuente limpia y profesional */
            margin: 10px auto;
            /* Espaciado entre los párrafos */
            line-height: 1.6;
            /* Mejora la legibilidad */
            max-width: 50%;
            /* Limita el ancho para que no ocupe todo el contenedor */
            padding: 10px 20px;
            /* Añade espacio interno */
            background-color: #f9f9f9;
            /* Color de fondo suave */
            border-radius: 8px;
            /* Bordes redondeados para suavizar el contorno */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Sombra suave para darle profundidad */
        }
    </style>
    <div class="container">
        <header>
            <div class="logo">
                <img src="img/Logo 1.jpg" alt="Logo" />
            </div>
            <ul>
                <li><a href="PrimeIndex.php">Inicio</a></li>
                <li><a href="facturacion.php">Mesa de Trabajo</a></li>
                <li><a href="DetalleVenta.php">Detalle venta</a></li>
                <li><a href="agendaProve.php">Agenda Proveedores</a></li>
                <li><a href="index.php">Cerrar Sesión</a></li>
            </ul>
            <h2><span id="clock"></span></h2>
        </header>

        <h1 class="titulo-prove">Facturación</h1>
        <form method="POST" action="">
            <label for="search">Buscar Cliente:</label>
            <input type="text" id="search" name="search" placeholder="Ingrese nombre o email del cliente">
            <button type="submit">Buscar</button>
        </form>
        <br>
        <div id="invoice" class="invoice">

            <div class="header-container">
                <div class="logo-container">
                    <img src="img/Logo 1.jpg" alt="Logo de la Empresa" class="company-logo">
                </div>
                <div class="content-container">
                    <div class="titulo-prove">
                        <h1 class="titulo-prove">Presupuesto</h1>
                    </div>
                    <div class="company-details">
                        <h2>TyH TRANSMISIONES</h2>
                        <p>Dirección: Emilio Gellati 255 Col.Tirolesa</p>
                        <p>Teléfono: 351-2282286 / 351-3573413</p>
                        <p>Email: transmisionestyh@hotmail.com</p>
                    </div>
                </div>
            </div>



            <div class="details-container">
                <section class="customer-details">
                    <h3>Detalles del Cliente:</h3>
                    <p>Nombre del Cliente: <?php echo isset($nombre) ? $nombre : ''; ?></p>
                    <p>Dirección del Cliente: <?php echo isset($direccion) ? $direccion : ''; ?></p>
                    <p>Teléfono: <?php echo isset($telefono) ? $telefono : ''; ?></p>
                    <p>Email: <?php echo isset($email) ? $email : ''; ?></p>
                </section>
                <section class="invoice-details">
                    <h3>Detalles del Presupuesto:</h3>
                    <p>Número de Presupuesto: <?php echo isset($num_presupuesto) ? $num_presupuesto : ''; ?></p>
                    <p>Fecha: <?php echo isset($fecha) ? $fecha : ''; ?></p>
                </section>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Descripción:</th>
                        <th>Cantidad:</th>
                        <th>Precio Unitario:</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo isset($descripcion) ? $descripcion : ''; ?></td>
                        <td><?php echo isset($cantidad) ? $cantidad : ''; ?></td>
                        <td><?php echo isset($precio_unitario) ? $precio_unitario : ''; ?></td>
                        <td><?php echo isset($precio_unitario) && isset($cantidad) ? $cantidad * $precio_unitario : ''; ?>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Subtotal</td>
                        <td><?php echo isset($subtotal) ? $subtotal : ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Impuesto</td>
                        <td><?php echo isset($impuesto) ? $impuesto : ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong><?php echo isset($total) ? $total : ''; ?></strong></td>
                    </tr>
                </tfoot>
            </table>
            <div class="h5live">
                <div class="block">
                    <div class="box">
                        <h5>Mant de Oferta:</h5>
                        <label>
                            <select>
                                <option value="2-7">2/7 días</option>
                                <option value="8-15">8/15 días</option>
                                <option value="16-30">16/30 días</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="block">
                    <div class="box">
                        <h5>Forma de pago:</h5>
                        <label>
                            <select>
                                <option value="Credito">T.Crédito</option>
                                <option value="Debito">T.Débito</option>
                                <option value="Contado-en">Cont al Encargar</option>
                                <option value="Contado-ent">Cont al Entregar</option>
                                <option value="Seña">Seña con liqui</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="block">
                    <div class="box">
                        <h5>Plazo de entrega:</h5>
                        <label>
                            <select>
                                <option value="7-15">7/15 días Aprox</option>
                                <option value="16-30">16/30 días Aprox</option>
                                <option value="31-45">31/45 días Aprox</option>
                                <option value="46-60">46/60 días Aprox</option>
                                <option value="61-75">61/75 días Aprox</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="block">
                    <div class="box">
                        <h5>Transporte:</h5>
                        <label>
                            <select>
                                <option value="incluido">Incluido</option>
                                <option value="no-incluido">No incluido</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="block">
                    <div class="box">
                        <h5>Cotizado:</h5>
                        <label>
                            <select>
                                <option value="90%">90%</option>
                                <option value="100%">100%</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>

            <footer>
                <p class="thank-you-message">¡Gracias por confiar en nosotros!</p>
                <p class="thank-you-message">Las fechas de entrega pueden variar según corresponda el motivo.</p>
            </footer>
        </div>
        <button onclick="generatePDF()">Generar PDF</button>

        <script>
            async function generatePDF() {
                const { jsPDF } = window.jspdf;
                const elementHTML = document.querySelector('#invoice');

                const canvas = await html2canvas(elementHTML, { backgroundColor: '#fff' });

                const imgData = canvas.toDataURL('image/png');

                const imgWidth = 210; // A4 width in mm
                const pageHeight = 500; // A4 height in mm

                // Ajustar escala (por ejemplo 80% del tamaño original)
                const scale = 0.6; // Cambia esto para ajustar el tamaño del contenido
                const scaledImgWidth = imgWidth * scale;
                const scaledImgHeight = (canvas.height * scaledImgWidth) / canvas.width;

                const doc = new jsPDF('p', 'mm');

                // Centrar el contenido escalado en la página
                const xOffset = (imgWidth - scaledImgWidth) / 2; // Calcular desplazamiento horizontal
                doc.addImage(imgData, 'PNG', xOffset, 0, scaledImgWidth, scaledImgHeight);

                doc.save('presupuesto.pdf');
            }
        </script>
        <script src="js/reloj.js"></script>
    </div>
</body>

</html>