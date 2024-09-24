<?php

function DatosLogin($vUsuario, $vClave, $vConexion) {
    
    $Usuario = array();

    // Encriptar la contraseña usando MD5
    $vClave = md5($vClave);

     // Preparar la consulta SQL
     $SQL = "SELECT u.id, u.email, u.password
     FROM users u
     WHERE u.email = '$vUsuario' AND u.password = '$vClave'";

     $result = mysqli_query($vConexion, $SQL);

     $data=mysqli_fetch_array($result);

     if(!empty($data)) {

        $Usuario["ID"] = $data["id"];
        $Usuario["EMAIL"] = $data["email"];
        $Usuario["PASSWORD"] = $data["password"];
     }
     return $Usuario;
}



?>