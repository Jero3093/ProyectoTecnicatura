<?php
session_start();
   if(isset($_SESSION['usuarioActivo']) && strlen($_SESSION['usuarioActivo'])>0 && $_SESSION['usu_rol'] == 1 ){
    header('location: ./../../maderastablas/principal.php');
   }else{
    header('location: ./../../ecommerce/index.php');
   }

   if(isset($_POST['input__Usuario']) && isset($_POST['input__Password'])){
        if(strlen($_POST['input__Usuario']) >0 && strlen($_POST['input__Password'])>0){
            if(!empty($_POST['input__Usuario']) || !empty($_POST['input__Password'])){  
                include('./bd.php');
                
                
                $consulta = "SELECT usu_nombre , usu_contraseña , usu_rol FROM usuarios where usu_nombre='".$_POST['input__Usuario']."' and usu_contraseña = '".$_POST['input__Password']."'";
                //$db = mysqli_select_db( $conexion, $nombreBD ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
                $datos= mysqli_query ($conexion,$consulta) or die(mysqli_error());

                $arrayUser =mysqli_fetch_array($datos);
                mysqli_close($conexion);
                

            if($arrayUser){
                $_SESSION['usuarioActivo'] = $arrayUser[0];
                $_SESSION['usu_rol'] = $arrayUser[2];
                header('location: ./../../maderastablas/principal.php');
            }else{
                header('location: ./../../maderastablas/index.php');
            }
        
            }
        }
   }
   
?> 

