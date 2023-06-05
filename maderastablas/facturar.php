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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Estilos jQueryUI -->
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.css">
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.structure.css">
    <link rel="stylesheet" href="./../jQueryUI/jquery-ui.theme.css">
    <title>Facturacion</title>
    
    
</head>
<body>
    <section>
        <?php
           include("./../assets/Components/Nav_articulo.php");
        ?>
    </section>
    
    <div class="FacturarTable_Container">
        <table class="FacturarTable table-bordered">
            <thead>
                <tr class="FacturarTable_Title-Container">
                    <th class="FacturarTable_Title">Id Articulo</th>
                    <th class="FacturarTable_Title">Descripcion</th>
                    <th class="FacturarTable_Title">Precio</th>
                    <th class="FacturarTable_Title">Cantidad</th>
                    <th class="FacturarTable_Title">Stock</th>
                    <th class="FacturarTable_Title">Precio Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="FacturarTable_Options-Container">
                    <th class="FacturarTable_Options" id="th_id_articulo"></th>
                    <th class="FacturarTable_Options">
                        <input type="text" id="txt_descripcion" class="FacturarTable_Options-Input" placeholder="Escribe una Descripcion">
                    </th>
                    <th class="FacturarTable_Options" id="th_precio"></th>
                    <th class="FacturarTable_Options">
                        <input type="number" value="0" id="txt_Cantidad" class="FacturarTable_Options-Input">
                    </th>
                    <th class="FacturarTable_Options">
                        <input type="number" value="0" id="txt_Stock" class="FacturarTable_Options-Input" disabled>
                    </th>
                    <th class="FacturarTable_Options" id="th_precioTotal">
                        <input type="text" value="0" id="txt_precioTotal" class="FacturarTable_Options-Input" disabled>
                    </th>
                </tr>
            </tbody>
        </table>
        <button type="button" class="FacturarTable_Submit" id="btnAgregarFactura" disabled>Agregar a la factura</button>

        <table class="FacturarTable table-bordered">
            <thead>
                <tr class="FacturarTable_Title-Container">
                    <th class="FacturarTable_Title">Id Articulo</th>
                    <th class="FacturarTable_Title">Descripcion</th>
                    <th class="FacturarTable_Title">Cantidad</th>
                    <th class="FacturarTable_Title">SubTotal</th>
                </tr>
            </thead>
            <tbody id="tbody_detalle">
               
            </tbody>
        </table>
        <table class="FacturarTable_Total">
            <tbody>
                <tr class="FacturarTable_Total-Options">
                    <th>
                        Total: $
                    </th>
                    <th>
                        <input type="text" value="0" id="txt_subtotalDetalle" class="form-control col-3" disabled>
                    </th>
                </tr>
            </tbody>
        </table>

        <div class="container-fluid col-sm-12">
            <button type="submit" class="btn btn-success col-12 col-lg-6 offset-lg-3 " id="btnProcesarCompra" disabled>Procesar compra</button>
        </div>
        <div class="container-fluid col-sm-12">
            <button type="submit" class="btn btn-danger col-12 col-lg-6 offset-lg-3" id="btnAnularCompra">Anular compra</button>
        </div>
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