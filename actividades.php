<?php
    require 'db.php';
    //CREATE--------------------------------------------------------------------------------------------------------------
        function crearActividadEnDB (){//ya no le paso parametros como antes
            //Se guandara la nueva actividad en un array que proviene del body del POST
            $actividad = json_decode(file_get_contents('php://input'), true);//viene en formato JSON y lo paso a array
            global $conexion;
            $consulta = "INSERT INTO actividades (titulo, ciudad, fecha, precio, usuario)
                        VALUES (?, ?, ?, ?, ?)";
                        
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param('sssds', //vinculacion(bind), 'ss..' se refiere a los tipos de tados string etc
                                        $actividad["titulo"],
                                        $actividad["ciudad"],
                                        $actividad["fecha"],
                                        $actividad["precio"],
                                        $actividad["usuario"]);

            $resultado = $stmt->execute();//ejejucar

            if($resultado){
                header("HTTP/1.1 200 OK");
                //Covierto los datos a json 
            }else{
                heade("HTTP/1.1 500 Internal server error");
            }
        } 

    //READ-----------------------------------------------------------------------------------------------------------------
        function listarActividades(){
            global $conexion;
            $actividades = array();
            $consulta = "SELECT * FROM actividades";
            $resultado = mysqli_query($conexion, $consulta);

            if($resultado){
                while($fila = mysqli_fetch_assoc($resultado)){
                    array_push($actividades, $fila);
                }
                header("HTTP/1.1 200 OK");
                //Covierto los datos a json 
                echo json_encode($actividades);
            }else{
                heade("HTTP/1.1 500 Internal server error");
            }
            return $actividades;
        }

    //UPDATE-------------------------------------------------------------------------------------------------------------
        function modificarActividad(){
            $id = $_GET["id"];//recoge el valor de la URL lo que hay despues del "?"
            $actividad = json_decode(file_get_contents('php://input'), true);//viene en formato JSON y lo paso a array
            global $conexion;

            $consulta = "UPDATE actividades 
                        SET titulo =?, 
                            ciudad=?, 
                            fecha=?, 
                            precio=?, 
                            usuario=?
                        WHERE id =?";
            
                        
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param('sssdsd', //vinculacion(bind), 'ss..' se refiere a los tipos de tados string etc
                                        $actividad["titulo"],
                                        $actividad["ciudad"],
                                        $actividad["fecha"],
                                        $actividad["precio"],
                                        $actividad["usuario"],
                                        $id);

            $resultado = $stmt->execute();//ejejucar

        }
    
    //DELETE-------------------------------------------------------------------------------------------------------------
        function borrarActividad(){
            $id = $_GET["id"];//recoge el valor de la URL lo que hay despues del "?"
            global $conexion;
            $consulta = "DELETE FROM actividades WHERE id =?";

            $stmt = $conexion->prepare($consulta);
            //'d' es para todos lo valores numericos
            $stmt->bind_param('d',$id);

            $resultado = $stmt->execute();//ejejucar

            if($resultado){
                header("HTTP/1.1 200 OK");
                //Covierto los datos a json 
            }else{
                heade("HTTP/1.1 500 Internal server error");
            }
        }

?>