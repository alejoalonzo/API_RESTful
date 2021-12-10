<?php
    require 'actividades.php';
    $tipo_solictud = $_SERVER["REQUEST_METHOD"];

    switch($tipo_solictud){
        case "GET":
            listarActividades();
            break;
        case "POST":
            crearActividadEnDB();
            break;
        case "DELETE":
            borrarActividad();
            break;
        case "PUT":
            modificarActividad();
            break;
    }

?>