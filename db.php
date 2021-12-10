<?php
    //Conexion---------------------------------------------------------------------------------------------
    $server = "localhost";
    $userDB = "root";
    $passwordDB = "";
    $nameDataBAse = "ifpdb";

    $conexion = mysqli_connect($server, $userDB, $passwordDB, $nameDataBAse);

    if(!$conexion){//Control de error para la conexion con DB
        echo  "Error en la conexion con la base de datos";
    }
    //-----------------------------------------------------------------------------------------------------

?>
