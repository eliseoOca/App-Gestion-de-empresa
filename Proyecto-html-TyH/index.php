<?php
session_start();
require_once 'conexion/conexion.php';
require_once 'funciones/funcio.logearse.php';
$Conexion = ConexionBD();
$Mensaje = '';

if (!empty($_POST['btnLogin'])) {
    $getUsuario = DatosLogin($_POST['email'], $_POST['password'], $Conexion);
    $Mensaje = 'Pudimos Loguearnos';

    if (!empty($getUsuario)) {

        $_SESSION['usuario_id'] = $getUsuario['ID'];
        $_SESSION['usuario_email'] = $getUsuario['EMAIL'];
        $_SESSION['usuario_password'] = $getUsuario['PASSWORD'];
        header('Location: PrimeIndex.php');
        exit;

    } else {
        $Mensaje = 'No te pudiste Loguearte.';
    }

}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>

<body>
    <div class="login-container">
        <img src="img/Logo2.jpg " alt="Logo de la empresa">
        <form id="loginForm" method="post">
            <input type="email" name="email">
            <input type="password" name="password">
            <button type="submit" name="btnLogin" value="login">Ingresar</button>
        </form>
    </div>
</body>
<!--<script src="js/login.js"> </script>-->

</html>