<!DOCTYPE html>
<html lang="en">

<head>
     
<meta charset="UTF-8">
    <?php 
    session_start();
    include("./../assets/js/funciones.php");
    comprobarUsuario();
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

   
    <title>Balance</title>
</head>

<body>
    <?php include("./../assets/Components/Nav_articulo.php"); ?>
        <!--Balance Calculator-->
        <form class="BalanceCalculator">
        <!--Titulo -->
        <p class="BalanceCalculator_Title">Calculo de Balance</p>
        <!--Balance-->
        <p class="BalanceCalculator_Percentage-Text" id="recibeBalance">$0</p>
        <!--Formulario-->
        <div class="BalanceCalculator_FormContainer">
            <div class="BalanceCalculator_InputContainer">
                <label for="FechaIncio">Ingrese la fecha de Inicio:</label>
                <input type="text" id='date_Inicio-balance' class="BalanceCalculator_Input" required>
            </div>
            <div class="BalanceCalculator_InputContainer">
                <label for="FechaFin">Ingrese la fecha de Finalización:</label>
                <input type="text" id='date_Final-balance' class="BalanceCalculator_Input" required>
            </div>
        </div>
        <input type="submit" id="btn_Calcular-balance" class="BalanceCalculator_ButtonCalcular" value="Calcular el Balance">
    </form>
        <!--Tabla Gastos-->
        <div class="container-fluid col-lg-6 col-sm-6 table-responsive mt-2" >
        <h1 class="h3 text-center">Lista de gastos</h1>
        <table class="table table-borderer table-bordered table-hover align-middle ">
            <thead>
                <tr class="table-dark align-middle">
                    <!-- <th scope="col">#</th> -->
                    <th class="text-center" scope="col">Numeracion</th>
                    <th class="text-center" scope="col">Concepto</th>
                    <th class="text-center" scope="col">Proveedor</th>
                    <th class="text-center" scope="col">Fecha</th>
                    <th class="text-center" scope="col">Gasto Total</th>
                </tr>
            </thead>
            <tbody id='recibeResultados_Gastos'>
                

            </tbody>
        </table>
        <h1 class="h3 text-center">Lista de ventas realizadas</h1>
        <table class="table table-borderer table-bordered table-hover align-middle ">
            <thead>
                <tr class="table-dark align-middle">
                    <!-- <th scope="col">#</th> -->
                    <th class="text-center" scope="col">Numeracion</th>
                    <th class="text-center" scope="col">ID Factura</th>
                    <th class="text-center" scope="col">Fecha de venta</th>
                    <th class="text-center" scope="col">Venta Total</th>
                </tr>
            </thead>
            <tbody id='recibeResultados_Ventas'>
                

            </tbody>
        </table>
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