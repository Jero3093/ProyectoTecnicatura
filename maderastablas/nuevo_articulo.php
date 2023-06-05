    <?php
    session_start();
    include("./../assets/js/funciones.php");
    comprobarUsuario();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <title>Document</title>
    </head>

    <body>
        <?php
        include("./../assets/Components/Nav_articulo.php");
        ?>
        <form action="" class="AddProduct_FormContainer">
            <p class="AddProduct_FormTitle">Ingresar Nuevo Articulo</p>
            <div class="AddProduct_FormContainer-Row">
                <!--Código de Artículo-->
                <div class="AddProduct_InputContainer">
                    <label for="CodArt">Codigo de Articulo:<span class="AddProduct_Obligatory">*</span></label>
                    <input type="text" name="codArticulo" id="txt__codArticulo" class="AddProduct_Input" required>
                </div>
                <!--Nombre Articulo-->
                <div class="AddProduct_InputContainer">
                    <label for="NomArt">Nombre de Articulo:<span class="AddProduct_Obligatory">*</span></label>
                    <input type="text" name="nombreArticulo" id="txt__nombreArticulo" class="AddProduct_Input" required>
                </div>
            </div>
            <div class="AddProduct_FormContainer-Row">
                <!--Precio Articulo-->
                <div class="AddProduct_InputContainer" style="margin-top: 3px;">
                    <label for="PrecioArt">Precio de Articulo:</label>
                    <input type="number" name="precioArticulo" id="txt__precioArticulo" class="AddProduct_Input">
                </div>
                <!--Stock Articulo-->
                <div class="AddProduct_InputContainer">
                    <label for="StockArt">Stock de Articulo:<span class="AddProduct_Obligatory">*</span></label>
                    <input type="number" name="cantidadArticulo" id="txt__cantidadArticulo" class="AddProduct_Input" required>
                </div>
                <!--Costo Creacion Articulo-->
                <div class="AddProduct_InputContainer" style="margin-top: 3px;">
                    <label for="costoCreacionArticulo">Costo de Creacion:</label>
                    <input type="number" name="costoCreacionArticulo" id="txt__costoCreacionArticulo" class="AddProduct_Input">
                </div>
            </div>
            <!--Categoria Articulo-->
            <div class="AddProduct_CategoryInput-Container">
                <label for="categoria">Elije la Categoria:</label>
                <div class="dropdown AddProduct_CategoryContainer">

                    <select name="categoria" id="select__categoria" class="form-select bg-light border-2 text-black">
                        <option value="none">---</option>'
                        <?php
                        cargarCategorias();
                        ?>
                    </select>
                </div>
                <!--Boton Categoria-->
                <button class="AddProduct_BotonCategoria" id="btnModal_nuevaCategoria" data-bs-toggle="modal" data-bs-target="#modal_nuevaCategoria">
                    Crear Nueva Categoria
                </button>
            </div>

            <!--Descripcion Articulo-->
            <label for="DescArt">Descripción de Articulo:</label>
            <input type="text" name="descripcionArticulo" id="txt__descripcionArticulo" class="AddProduct_Input">

            <!--Materiales Articulo-->
            <label for="MatsArt">Materiales de Articulo:</label>
            <input type="text" name="MaterialesArticulo" id="txt__materialesArticulo" class="AddProduct_Input">

            <!--Proveedor-->
            <label for="MatsArt">Proveedor:</label>
            <input type="text" name="proveedor" id="txt__proveedor" class="AddProduct_Input">
            <div class="AddProduct_FormContainer-Row">
                <div class="AddProduct_InputContainer">
                    <!--Concepto Articulo-->
                    <label for="MatsArt">Concepto:</label>
                    <input type="text" name="provConcepto" id="txt__provConcepto" class="AddProduct_Input">
                </div>
                <div class="AddProduct_InputContainer">
                    <!--Gasto Total-->
                    <label for="MatsArt">Gasto Total:</label>
                    <input type="number" name="gastoTotal" id="txt__gastoTotal" class="AddProduct_Input">
                </div>
            </div>
            <!--Boton Enviar-->
            <input type="submit" value="Ingresar Nuevo Articulo" id="btn__ingresarArticulo" class="AddProduct_BotonEnviar">
        </form>

        <!-- MODAL Nueva Categoría-->

        <div class="modal fade" id="modal_nuevaCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_nuevaCategoria" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_nuevaCategoria">Insertar nueva categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5 pt-1 pb-1">
                        <div class="col-12">
                            <label for="txt__nombre_nuevaCategoria" class="form-label">Nombre de la nueva categoria</label>
                            <input type="text" name="txt__nombre_nuevaCategoria" id="txt__nombre_nuevaCategoria" class="form-control">

                            <label for="txt__observacion_nuevaCategoria" class="form-label">Observacion</label>
                            <input type="text" name="txt__observacion_nuevaCategoria" id="txt__observacion_nuevaCategoria" class="form-control">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="modalnuevaCategoria">Añadir categoría</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Termina Nueva Categoría -->
    </body>
    <link rel="stylesheet" href="./../assets/css/style.css">
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