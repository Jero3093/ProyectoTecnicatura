
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

   

    <title>Articulos</title>
</head>
<body>
<!-- MODAL Insertar Stock-->
        
<div class="modal fade" id="modal_insertarStock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Insertar Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-5 pt-1 pb-1" id='recibe_data-insertarStock'>
        <form>
          <div class="row mb-3">
            <div class="col">
              <label for="inputArticulo" class="form-label">ID del Artículo:</label>
              <input type="text" class="form-control" id="inputArticulo" placeholder="Ingrese el ID del artículo">
            </div>
            <div class="col">
              <label for="inputStock" class="form-label">Stock:</label>
              <input type="text" class="form-control" id="inputStock" placeholder="Ingrese el stock">
            </div>
          </div>
          <hr>
          <div class="mb-3">
            <label for="inputGasto" class="form-label">Gasto:</label>
            <input type="text" class="form-control" id="inputGasto" placeholder="Ingrese el gasto">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success" id="modal-insertarStock-btn">Insertar Stock</button>
      </div>
    </div>
  </div>
</div>


    
    <!-- Termina MODAL Insertar Stock -->
   
<!-- MODAL MODIFICAR ARTICULO-->
        
<div class="modal fade" id="modal_modificarArticulo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modificar Articulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-1 pb-1">
            
            <div class="col-12">
                    <label for="modal_modificiarArticulo__Categoria" class="form-label">Elija la categoria:</label>
                    <select name="modal_modificiarArticulo__Categoria" id="modal_modificiarArticulo__Categoria" class="form-select">
                    
                    <?php 
                        cargarCategorias(); 
                    ?>
                    </select>
                    
            </div>
           
                <div class="col-12 cargaModal">
                  Cargando...
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="modalModificar">Modificar articulo</button>
            </div>
        </div>
            
      </div>
    </div>
    </div>
    
    <!-- Termina MODAL MODIFICAR ARTICULO -->

<!-- MODAL ELIMINAR ARTICULO-->
        
<div class="modal fade" id="modal_eliminarArticulo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Eliminar Articulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-1 pb-1" id="datos_modalEliminar">
            
            </div>
            
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="modalEliminar">Eliminar articulo</button>
            </div>
            </div>
            
        </div>
    </div>
    </div>
         
    <!-- Termina MODAL ELIMINAR ARTICULO -->

<!-- MODAL Nueva Categoría-->
        
<div class="modal fade" id="modal_nuevaCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_nuevaCategoria" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-scrollable">
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

    
    <section>
        <?php
         include("./../assets/Components/Nav_articulo.php");
         echo '<p class="AddProduct_FormTitle">Listado de articulos</p>';
         include("./../assets/js/buscador_listaArticulos.php");
        ?>
    </section>


    <div class="container-fluid table-responsive ">
        <table class="table table-bordered table-primary table-sm vertical-align middle-align table-hover">
        <thead class="table-dark">
            <tr >
            
            <th class="text-center align-middle" scope="col-1">Foto</th>
            <th class="text-center align-middle" scope="col-1">Id_Art</th>
            <th class="text-center align-middle" scope="col-1">Cod</th>
            <th class="text-center align-middle" scope="col-1">Nombre</th>
            <th class="text-center align-middle" scope="col-1">Precio</th>
            <th class="text-center align-middle" scope="col-1">Stock</th>
            <th class="text-center align-middle" scope="col-1">Costo creacion</th>
            
            
            <th class="text-center align-middle" scope="col-1">Categoria</th>
            <th class="text-center align-middle" scope="col-1">Observacion</th>
            <th class="text-center align-middle" scope="col-1">Materiales</th>
            <th class="text-center align-middle" scope="col-1">Notas</th>
            <th class="text-center align-middle" scope="col-1">Acción</th>
            
        </thead>
        <tbody class="text-center col-12" id='recibe_listaArticulos'>
            <?php
                mostrarArticulos();
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