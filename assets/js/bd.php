<?php
    $nombreBD = 'barredadb';
    //$nombreBD = 'id19677335_barredadb';
    $conexion = mysqli_connect("localhost", "root", "","$nombreBD");
        if(!$conexion){
            echo "no se ha conectado a la base de datos";
        }
        
    
        /* 
           $host = "localhost";
            $username="id19677335_barredadb";
            $nombreBD = 'id19677335_barredadb';
            $conexion = mysqli_connect("localhost", "id19677335_admin", "Proyecto(utu)123","$nombreBD");
                if(!$conexion){
                    echo "no se ha conectado a la base de datos";
                }
         */
       
?>