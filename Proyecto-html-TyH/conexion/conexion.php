<?php

function ConexionBD()
{
    $Host = 'localhost';
    $User = 'root';
    $Password = '';
    $BaseDeDatos = 'tyh';

    //procedo al intento de conexion con esos parametros
    $linkConexion = mysqli_connect($Host, $User, $Password, $BaseDeDatos);
    if ($linkConexion != false)

        return $linkConexion;
    else
        die('No se pudo establecer la conexion.');


}




?>