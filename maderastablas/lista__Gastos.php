<!DOCTYPE html>
<html lang="en">

<head>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos jQueryUI -->
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.css">
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.structure.css">
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.theme.css">

    <title>Listado Facturas</title>
</head>

<body>
    <section>
        <?php
        include("./../assets/Components/Nav_articulo.php");
        ?>
    </section>

    <div class="dropdown-center row justify-content-center">
        <button class="btn btn-info dropdown-toggle col-6" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Elija tipo de búsqueda
        </button>
        <ul class="dropdown-menu col-6" id='dropdown_busquedaGastos'>
            <li><a class="dropdown-item" data-opcion='Concepto'>Concepto</a></li>
            <li><a class="dropdown-item"data-opcion='Proveedor'>Proveedor</a></li>
            <li><a class="dropdown-item"data-opcion='Entre fechas'>Entre fechas</a></li>
        </ul>
    
    </div>
    <!-- Contenedor de los buscadores-->
    <div class="container-fluid" id='contieneBuscador'>
        <div class="container-search d-none mt-4 mb-3 col-sm-12 col-lg-8 m-auto" id='buscadorConcepto'>
            <input type="search" id="txt_searchConcepto" class="InputSearch-Gastos" placeholder="Buscar: Concepto ">
        </div>  
        <div class="container-search d-none mt-4 mb-3 col-sm-12 col-lg-8 m-auto" id='buscadorProveedor'>
            <input type="search" id="txt_searchProveedor" class="InputSearch-Gastos" placeholder="Buscar: Proveedor ">
        </div>
        <div class="container-fluid d-none" id='buscadorFechas'>
            <div class="row justify-content-center">
              <div class="col-md-6">
                <form class="search-form mt-3">
                  <div class="input-group mb-0">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="date_Inicio-Gastos" placeholder="yyyy-mm-dd">
                        <label for="FechaInicio">Fecha Inicio</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="date_Final-Gastos" placeholder="yyyy-mm-dd">
                        <label for="FechaFinal">Fecha Final</label>
                    </div>
                    
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary col-6" id="buscar_Fecha-Gastos">Buscar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
    </div>
    

    <div class="container-fluid col-lg-6 col-sm-12 table-responsive mt-2" id='recibeResultados'>

        <table class="table table-borderer table-bordered table-hover align-middle">
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
            <tbody id='recibeListado_Gastos'>
                <?php
                mostrarGastos();
                ?>

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