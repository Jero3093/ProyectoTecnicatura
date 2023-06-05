<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <?php 
        session_start();
        include("./../assets/js/funciones.php");
        if(isset($_SESSION['usuarioActivo'])){
            header('location: ./principal.php');
        }else{
        }
    ?>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Link a mis estilos -->
    <link rel="stylesheet" href="./../assets/css/style.css">
    <!--Icono en la pestaña -->
    <link rel="shortcut icon" href="./../assets/icons/favicon.png">
    <!--Iconos de bootstrap  -->
    <!-- <link rel="stylesheet" href="./../bootstrapIcons/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!--Estilos Bootstrap -->
    <!-- <link href="./../bootstrap/css/bootstrap.min.css" rel="stylesheet" > -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Estilos jQueryUI -->
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.css">
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.structure.css">
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.theme.css">

    <title>Iniciar Sesion</title>
</head>
<body>

    <div class="container">
        <form class="LoginContainer" action="./../assets/js/redirect.php" method="post">
            <img src="./../assets/icons/icon.png" alt="Logo" class="LoginContainer_Logo">
            <!--Input Usuarios-->
            <div class="Login_InputContainer">
                <label class="Login_InputContainer-Label" for="input__User">Usuario:</label>
                <input type="text" id="input__User" name="input__Usuario" class="Login_InputContainer-Input" required placeholder="Ingrese su Usuario..." />
            </div>
            <!--Input Contraseña-->
            <div class="Login_InputContainer">
                <label class="Login_InputContainer-Label" for="input__Password">Contraseña:</label>
                <input type="password" id="input__Password" name="input__Password" class="Login_InputContainer-Input" required placeholder="Ingrese su Contraseña..." />
            </div>
            <!--Boton Enviar-->
            <button type="submit" class="Login_SubmitButton">Iniciar Sesión</button>
            <div class="LoginContainer_Home">
                <p class="LoginContainer_Home-Text">Si no eres Administrador - 
                    <a href="./../ecommerce/index.php" class="LoginContainer_Home-Link">Ingresar sin Usuario</a>
                </p>
            </div>
        </form>



        <!-- <form action="./../ecommerce/index.php">
            <button type="submit" class="btn btn-success mb-8">Continuar sin iniciar</button>
        </form>  -->
    </div>

</body>
 <!--Importa librería jquery -->
    <!-- <script src="./../jQuery/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!--Importa librería jQueryUI -->
    <script src="./../jQueryUI/jquery-ui.min.js"></script>
    <!--Importa librería boostrap -->
    <!-- <script src="./../bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!--Importo javascript propio -->
    <script src="./../assets/js/functions.js"></script>
    <!--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    -->


</html>