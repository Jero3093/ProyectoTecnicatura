<?php 
     

    //Carga el producto al modal modificar
        if(isset($_POST['action']) && $_POST['action'] == 'modificarArticulo'){
          $modificarArticulo = $_POST['modificar__Articulo'];
            if(!empty($modificarArticulo)){
              
              include('./../js/bd.php');
                $consulta = "SELECT * FROM `articulos` WHERE art_id = ".$modificarArticulo."";
            
                $datos= mysqli_query ($conexion,$consulta);
                
                $articulo = new stdClass();
                
                mysqli_close($conexion);
                // 4) Ir Imprimiendo las filas resultantes
                while ($fila =mysqli_fetch_array($datos)){
                  $art_nom = $fila['art_nom'];
                  $art_desc = $fila['art_desc'];
                  $art_precio = $fila['art_precio'];
                  $art_stock = $fila['art_stock'];
                  $art_costo = $fila['art_costo'];
                  $art_vendible = $fila['art_vendible'];
                  $art_deshabilitado = $fila['art_deshabilitado'];
                  $art_categoria = $fila['art_categoria'];
                  $art_materiales = $fila['art_materiales'];
                  $art_notas = $fila['art_notas'];
                 
                  $articulo->art_nom =$art_nom;
                  $articulo->art_desc =$art_desc;
                  $articulo->art_precio =$art_precio;
                  $articulo->art_stock =$art_stock;
                  $articulo->art_costo =$art_costo;
                  $articulo->art_vendible =$art_vendible;
                  $articulo->art_deshabilitado =$art_deshabilitado;
                  $articulo->art_categoria =$art_categoria;
                  $articulo->art_materiales =$art_materiales;
                  $articulo->art_notas =$art_notas;
                 
                  
                }

                

                if($articulo){
                      $data = $articulo;
                    }else{
                      $data = 0;
                    }
  
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                    exit;
                }
              
               
    
                
              }        

    //Termina Carga el producto al modal modificar

    //Modifica el articulo del modal
    
    if(isset($_POST['action']) && $_POST['action'] == 'modalModificar_Articulo'){
      $modificarArticulo = $_POST['modalModificar_Articulo'];
        if(!empty($modificarArticulo)){  
                  include('./../js/bd.php');
                 
                    $consulta = "UPDATE `articulos` SET `art_nom`='".$modificarArticulo[2]."',`art_desc`='".$modificarArticulo[6]."',`art_precio`='".$modificarArticulo[3]."',`art_stock`='".$modificarArticulo[4]."',`art_costo`='".$modificarArticulo[5]."',`art_vendible`='',`art_deshabilitado`='',`art_categoria`='".$modificarArticulo[1]."',`art_materiales`='".$modificarArticulo[7]."' , `art_notas`='".$modificarArticulo[8]."' where `art_id` = '".$modificarArticulo[0]."' ";
                    //$db = mysqli_select_db( $conexion, $nombreBD ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
                    $datos= mysqli_query ($conexion,$consulta);
          
                    mysqli_close($conexion);


                    if(isset($datos)){
                      $data = 1;
                    }else{
                      $data = 'error';
                    }
                
                
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                exit; 
            
        }
      }

    //Termina- Modifica el articulo modal

    //Ingresar nuevo articulo
    if(isset($_POST['action']) && $_POST['action'] == 'nuevoArticulo'){
      $nuevoArticulo = $_POST['nuevoArticulo'];
        if(!empty($nuevoArticulo)){
          $fechaActual = date('Y-m-d');
          //print_r($_POST['nuevoArticulo']);
          $articulo = new stdClass();

          $articulo->codigo = $nuevoArticulo[0];
          $articulo->nombre = $nuevoArticulo[1];
          $articulo->descripcion= $nuevoArticulo[2];
          $articulo->precio= $nuevoArticulo[3];
          $articulo->stock= $nuevoArticulo[4];
          $articulo->costo= $nuevoArticulo[5];
          $articulo->categoria= $nuevoArticulo[6];
          $articulo->materiales= $nuevoArticulo[7];
          $articulo->proveedor= $nuevoArticulo[8];
          $articulo->concepto= $nuevoArticulo[9];
          $articulo->gastoTotal= $nuevoArticulo[10];

          if($articulo->codigo  =='' || $articulo->nombre == '' || $articulo->stock == '' || $articulo->categoria == '' || $articulo->categoria == 'none' || $articulo->proveedor  =='' ||$articulo->concepto  =='' ||$articulo->gastoTotal  ==''){
            $data = 'Faltan datos';
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
          }else{

            include('./../js/bd.php');
            $consulta__siExiste= "SELECT * FROM articulos WHERE art_cod = '$articulo->codigo'";
            $datos= mysqli_query ($conexion,$consulta__siExiste);
            $siExiste = mysqli_affected_rows($conexion);
            mysqli_close($conexion);

            if($siExiste==0){
              include('./../js/bd.php');
              $insertarArticulo = "INSERT INTO `articulos`(`art_id`, `art_cod`, `art_nom`, `art_desc`, `art_precio`, `art_stock`, `art_costo`, `art_vendible`, `art_deshabilitado`, `art_categoria`, `art_materiales`) VALUES (NULL,'".$articulo->codigo."','".$articulo->nombre."','".$articulo->descripcion."',".$articulo->precio.",".$articulo->stock.",".$articulo->costo.",'S','S','".$articulo->categoria."','".$articulo->materiales."')";

              $insertarGasto = "INSERT INTO `gastos` (`gas_id`, `gas_fecha`, `gas_proveedor`, `gas_concepto`, `gas_cantidad`, `gas_total`) VALUES (NULL, '".$fechaActual."', '".$articulo->proveedor."','".$articulo->concepto."', '".$articulo->stock."', '".$articulo->gastoTotal."')";
  
                if (mysqli_query ($conexion,$insertarGasto) && mysqli_query ($conexion,$insertarArticulo)) {
                  $data = 'exito';
                  echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else {
                  $data = "Error al insertar el artículo: " . mysqli_error($conexion);
                }
                mysqli_close($conexion);
                exit; 

            }else{
              $data='dato duplicado';
            }

            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit; 
          }
         
        } 
    }
    //Termina - ingresar nuevo articulo

    //Carga id para ELIMINAR en MODAL
    if(isset($_POST['action']) && $_POST['action'] == 'eliminarArticulo'){
      $eliminarArticulo = $_POST['eliminar__Articulo'];
        if(!empty($eliminarArticulo)){
          
          include('./../js/bd.php');
            $consulta = "SELECT * FROM `articulos` WHERE art_id = ".$eliminarArticulo."";
        
            $datos= mysqli_query ($conexion,$consulta);
            
            $articulo = new stdClass();
            
            mysqli_close($conexion);
            // 4) Ir Imprimiendo las filas resultantes
            while ($fila =mysqli_fetch_array($datos)){
              $art_nom = $fila['art_nom'];
              
              $articulo->art_nom =$art_nom;
              
            }

            

            if($articulo){
                  $data = $articulo->art_nom;
                }else{
                  $data = 0;
                }

                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                exit;
            }
          
          }        

    //Termina Carga id para ELIMINAR en MODAL

    //Elimina el articulo seleccionado
if(isset($_POST['action']) && $_POST['action'] == 'modalEliminar_Articulo'){
  $eliminarArticulo = $_POST['modalEliminar_Articulo'];
    if(!empty($eliminarArticulo)){  
              include('./../js/bd.php');
              
              $id = $eliminarArticulo;
              
                $consulta = "DELETE FROM `articulos` WHERE `articulos`.`art_id` = $id";
                //$db = mysqli_select_db( $conexion, $nombreBD ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
                $datos= mysqli_query ($conexion,$consulta) or die($mysqli->error);

                mysqli_close($conexion);

            if($datos){
              $data = $datos;
            }else{
              $data= 0 ;
            }
            
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit; 
        
    }
  }
    //Termina - //Elimina el articulo seleccionado

    //Inserta Nueva categoria en articulos
  if(isset($_POST['action']) && $_POST['action'] == 'modalnueva_Categoria'){
    $nuevaCategoria = $_POST['modalnueva_Categoria'];

    $categoria = new stdClass();

    $categoria->nombre = $nuevaCategoria[0];
    $categoria->observacion = $nuevaCategoria[1];
      if(!empty($nuevaCategoria) && strlen($categoria->nombre)>0){  
                include('./../js/bd.php');
                
                
                  $consulta = "INSERT INTO `categorias`(`cat_id`, `cat_nom`, `cat_obs`) VALUES ('','$categoria->nombre','$categoria->observacion')";
                  //$db = mysqli_select_db( $conexion, $nombreBD ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
                  
                  if(mysqli_query ($conexion,$consulta)){
                    $data = 'exito';
                  }else{
                    $data= 0 ;
                  }
                  
              mysqli_close($conexion);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
              exit; 
          
      }else{
        $data = 0;
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
              exit; 
      }
    }
    //Termina - //Inserta Nueva categoria en articulos

    //Cargar imagen de producto al modal de modificar
    if(isset($_POST['action']) && $_POST['action'] == 'cambiar__imgProducto'){
      $cambiarimgProducto = $_POST['cambiar__imgProducto'];
        if(!empty($cambiarimgProducto)){
          
          include('./../js/bd.php');
          
            $consulta = "SELECT `art_id`,`art_imagen` FROM `articulos` WHERE art_id = ".$cambiarimgProducto."";
        
            $datos= mysqli_query ($conexion,$consulta);
            
            $articulo = new stdClass();
            
            mysqli_close($conexion);
            // 4) Ir Imprimiendo las filas resultantes
            while ($fila =mysqli_fetch_array($datos)){
              $art_imagen = $fila['art_imagen'];
              $art_id = $fila['art_id'];
              
              $articulo->art_id =$art_id;
              $articulo->art_imagen =$art_imagen;
              
            }

            

            if($articulo){
                  $data = $articulo;
                }else{
                  $data = 0;
                }

                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                exit;
            }
          
          }        

//Termina Cargar imagen de producto al modal de modificar

// Acceder a los datos del archivo

  if(isset($_FILES['images']) && isset($_POST['idArt_imagen'])) {
      $archivos = $_FILES['images'];

      // Iterar sobre los archivos subidos
      foreach($archivos['name'] as $indice => $nombre) {
          $tipo = $archivos['type'][$indice];
          $ruta_temporal = $archivos['tmp_name'][$indice];
          $error = $archivos['error'][$indice];
          $tamano = $archivos['size'][$indice];

          // Obtener la extensión del archivo original
          $extension = pathinfo($nombre, PATHINFO_EXTENSION);

          // Generar un nuevo nombre de archivo único con la extensión
          $nuevo_nombre = md5($nombre) . '.' . $extension;

          // Aquí puedes realizar validaciones adicionales si es necesario

          // Mover el archivo a la ubicación deseada con el nuevo nombre
          $destino = './../../assets/images/' . $nuevo_nombre;
          $destinoQuery = './../assets/images/' . $nuevo_nombre;
          if(move_uploaded_file($ruta_temporal, $destino)) {

            include('./../js/bd.php');
            $consulta = "INSERT INTO `art_imagenes` (`art_id`, `ruta_img`) VALUES ('".$_POST['idArt_imagen']."','".$destinoQuery."')";
            $datos = mysqli_query($conexion, $consulta);
            mysqli_close($conexion);
            
              // El archivo se ha subido exitosamente con el nuevo nombre y la extensión
              echo "¡La imagen $nombre se ha subido correctamente con el nuevo nombre $nuevo_nombre!";
          } else {
              // Ocurrió un error al mover el archivo
              echo "Error al subir la imagen $nombre. Inténtalo de nuevo.";
          }
      }
  } else {
      
  }




    //Termina---Actualiza imagen del articulo seleccionado

    //Buscar producto en FACTURACION

    if(isset($_POST['action']) && $_POST['action'] == 'searchArticulo'){
      if(!empty($_POST['articulo'])){
        include('./../js/bd.php');
        $consulta = "SELECT * FROM `articulos` WHERE art_nom LIKE '".$_POST['articulo']."%';";
        $db = mysqli_select_db( $conexion, $nombreBD ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
        
        $datos= mysqli_query ($conexion,$consulta);
        
        $articulo = new stdClass();
        // 4) Ir Imprimiendo las filas resultantes
        while ($fila =mysqli_fetch_array($datos)){
          $id[] = $fila['art_id'];
          $nombre [] = $fila['art_nom'];
          $precio [] = $fila['art_precio'];
          $stock [] = $fila['art_stock'];
          
          $articulo->id = $id;
          $articulo->nombre = $nombre;
          $articulo->precio = $precio;
          $articulo->stock = $stock;
        }
        
          
          mysqli_close($conexion);

          if($articulo){
                $data = $articulo;
              }else{
                $data = 0;
              }

            echo json_encode($data , JSON_UNESCAPED_UNICODE);
           
            exit;
          }
        
      }
  //Termina---Buscar producto en FACTURACION

  //Procesar venta en facturacion
    $idFactura;
    /* if(isset($_POST['action']) && $_POST['action'] == 'procesarVenta'){
      if(!empty($_POST['procesarVenta'])){
        include('./../js/bd.php');
        
        $formated_DATE = date('Y-m-d');

        $consulta = "INSERT INTO `factura`(`fact_id`, `fact_fecha`) VALUES (null,'$formated_DATE')";
            
            $insertFactura= mysqli_query ($conexion,$consulta) or die($mysqli->error);
            mysqli_close($conexion);
            
                if($insertFactura == 1){
                    include('bd.php');
                    $result = mysqli_query($conexion,"SELECT Max(fact_id) FROM factura");
                    $row = mysqli_fetch_array($result);
                    $idFactura = $row[0];
                    
                    
                    //mysqli_close($conexion);
                    
                    if($idFactura>0){
                      //$arrayVenta = $_POST['procesarVenta'];
                      
                      for ($i=0; $i < count($_POST['procesarVenta']) ; $i++) { 
                        
                        $venta_renglon=$_POST['procesarVenta'][$i]['nroRenglon'];
                        $venta_articulo=$_POST['procesarVenta'][$i]['id_articulo'];
                        $venta_cantidad=$_POST['procesarVenta'][$i]['cantidad'];
                        $venta_precio=$_POST['procesarVenta'][$i]['precioTotal'];
                      
                        include('bd.php');
                        
                        $consulta ="INSERT INTO `detalle_factura`(`dfact_renglon`, `fact_id`, `art_id`, `dfact_cantidad`, `dfact_precio`) VALUES ('$venta_renglon','$idFactura','$venta_articulo','$venta_cantidad','$venta_precio')";
                        $datos= mysqli_query ($conexion,$consulta);
                      
                        
                        if($datos){
                          include('bd.php');
                          $consultaStock = "call `restar_stock`($venta_articulo,$venta_cantidad);";
                          $datosStock= mysqli_query ($conexion,$consultaStock);
                         
                          // Imprimir los datos
                          
                         if ($datosStock) {
                          echo json_encode(print_r($_POST['procesarVenta']),JSON_UNESCAPED_UNICODE);
                          exit;
                         }else{
                          echo json_encode('error stock',JSON_UNESCAPED_UNICODE);
                          exit;
                         }
                        
                         
                        }

                        
      
                      }
                      
                    }
                    mysqli_close($conexion);
                    if($idFactura){
                      $data = $datos;
                    }else{
                      $data = 0;
                    }
      
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                    exit;
              }
        
            }
    } */
  
    if (isset($_POST['action']) && $_POST['action'] == 'procesarVenta') {
      if (!empty($_POST['procesarVenta'])) {
          include('./../js/bd.php');
  
          $formated_DATE = date('Y-m-d');
  
          $consulta = "INSERT INTO `factura`(`fact_id`, `fact_fecha`) VALUES (null,'$formated_DATE')";
          $insertFactura = mysqli_query($conexion, $consulta) or die($mysqli->error);
  
          if ($insertFactura) {
              $idFactura = mysqli_insert_id($conexion);
  
              if ($idFactura) {
                  foreach ($_POST['procesarVenta'] as $venta) {
                      $venta_renglon = $venta['nroRenglon'];
                      $venta_articulo = $venta['id_articulo'];
                      $venta_cantidad = $venta['cantidad'];
                      $venta_precio = $venta['precioTotal'];
  
                      $consulta = "INSERT INTO `detalle_factura`(`dfact_renglon`, `fact_id`, `art_id`, `dfact_cantidad`, `dfact_precio`) VALUES ('$venta_renglon', '$idFactura', '$venta_articulo', '$venta_cantidad', '$venta_precio')";
                      $datos = mysqli_query($conexion, $consulta);
  
                      if ($datos) {
                          $consultaStock = "CALL `restar_stock`('$venta_articulo', '$venta_cantidad')";
                          $datosStock = mysqli_query($conexion, $consultaStock);
  
                          if ($datosStock) {
                              echo json_encode($_POST['procesarVenta'], JSON_UNESCAPED_UNICODE);
                          } else {
                              echo json_encode('Error al restar stock', JSON_UNESCAPED_UNICODE);
                          }
                      } else {
                          echo json_encode('Error al insertar en detalle_factura', JSON_UNESCAPED_UNICODE);
                      }
                  }
              } else {
                  echo json_encode('Error al obtener ID de factura', JSON_UNESCAPED_UNICODE);
              }
          } else {
              echo json_encode('Error al insertar factura', JSON_UNESCAPED_UNICODE);
          }
  
          mysqli_close($conexion);
          exit;
      }
  }
  


  //Termina---Procesar venta en facturacion

   //Buscador Ecommerce

   if((isset($_POST['action'])) && $_POST['action']=='buscar_ecommerce'){
    //SELECT * FROM articulos WHERE articulos.art_nom LIKE ('%', palabra , '%');
    include('bd.php');
                      
    $consulta ="SELECT articulos.*, categorias.*, primera_imagen.ruta_img AS art_imagen
    FROM articulos 
    INNER JOIN categorias ON articulos.art_categoria = categorias.cat_id 
    LEFT JOIN (
      SELECT art_id, ruta_img
      FROM art_imagenes
      GROUP BY art_id
    ) AS primera_imagen ON articulos.art_id = primera_imagen.art_id 
     WHERE articulos.art_nom Like '%".$_POST['buscar_ecommerce']."%' ORDER BY art_id DESC;";
    $datos= mysqli_query ($conexion,$consulta);

    $busqueda = new stdClass();
    if ($fila = mysqli_num_rows($datos)>0) {
      while ($fila = mysqli_fetch_array($datos)) {
        //<th scope="col-1">'.$i++.'</th>
        echo '<div class="ProductsList_Card" id="art_Ecommerce" onclick="redireccionArticulo(' . $fila["art_id"] . ')">
        <div class="contain-imgCard">
            <img src="';
            if(!empty($fila['art_imagen'])) {
            echo ''.$fila["art_imagen"] .'" alt="error al cargar imagen" class="ProductsList_Card-Img">
            </div>
            <div class="ProductsList_Card-Content">
            <span class="ProductsList_Card-Cat">' . $fila["cat_nom"] . '</span>
            <div class="ProductsList_Card-Name_Container">
            <h5 class="ProductsList_Card-Name">' . $fila["art_nom"] . '</h5>
            </div>
            <div class="text-center"> Disponibles: <span style="
            color: red;
            /* font-style: revert; */
            /* font-weight: 100; */
            font-size: large;
            ">' . $fila["art_stock"] . '</span> </div>
            <h4 class="ProductsList_Card-Price">$' . $fila["art_precio"] . '</h4>
            </div>
            </div>';
            }else{
              echo './../assets/images/default.png" alt="error al cargar imagen" class="ProductsList_Card-Img">
            </div>
            <div class="ProductsList_Card-Content">
            <span class="ProductsList_Card-Cat">' . $fila["cat_nom"] . '</span>
            <div class="ProductsList_Card-Name_Container">
            <h5 class="ProductsList_Card-Name">' . $fila["art_nom"] . '</h5>
            </div>
            <div class="text-center">Disponibles:' . $fila["art_stock"] . '</div>
            <h4 class="ProductsList_Card-Price">$' . $fila["art_precio"] . '</h4>
            </div>
            </div>';
                  }
      }
    }else{
      echo '<div class="h3 mb-5 pb-5 mt-0">No se encontraron resultados</div>';
    }
    exit;
    mysqli_close($conexion);
  }


//Termina---Buscador Ecommerce

//Comienza verificador de existencia ID articulo

if(isset($_POST['action']) && $_POST['action'] == 'buscar_idArticulo'){
  $buscar_idArticulo = $_POST['buscar_idArticulo'];
    if(!empty($buscar_idArticulo)){  
              include('./../js/bd.php');
             
                $consulta = "SELECT art_cod from articulos where art_cod LIKE '".$_POST['buscar_idArticulo']."%';";
                //$db = mysqli_select_db( $conexion, $nombreBD ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
                $datos= mysqli_query ($conexion,$consulta);
                $resultado =mysqli_fetch_array($datos);
                mysqli_close($conexion);


                if($resultado){
                  $data = 'Existe';
                }else{
                  $data = 'noExiste';
                }
            
            
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit; 
        
    }
  }

//Termina --- verificador de existencia ID articulo

//Comienza verificador de existencia Nombre de articulo

if(isset($_POST['action']) && $_POST['action'] == 'buscar_nombreArticulo'){
  $buscar_nombreArticulo = $_POST['buscar_nombreArticulo'];
    if(!empty($buscar_nombreArticulo)){  
              include('./../js/bd.php');
             
                $consulta = "SELECT art_nom from articulos where art_nom LIKE '".$_POST['buscar_nombreArticulo']."%';";
                //$db = mysqli_select_db( $conexion, $nombreBD ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
                $datos= mysqli_query ($conexion,$consulta);
                $resultado =mysqli_fetch_array($datos);
                mysqli_close($conexion);


                if($resultado){
                  $data = 'Existe';
                }else{
                  $data = 'noExiste';
                }
            
            
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit; 
        
    }
  }

//Termina --- verificador de existencia Nombre de articulo

//Comienza --- Calcular Balance

if(isset($_POST['action']) && $_POST['action'] == 'calcularBalance'){
  $calcularBalance = $_POST['calcularBalance'];
    if(!empty($calcularBalance)){  
              include('./../js/bd.php');
              if ($calcularBalance[0] == $calcularBalance[1]) {
                
                $consulta= "SELECT ventas_total AS total_ventas,
                COALESCE(ROUND(gastos_total, 2), 0) AS total_gastos,
                ventas_total - COALESCE(ROUND(gastos_total, 2), 0) AS ganancia_total
                FROM (
                    SELECT SUM(df.dfact_precio) AS ventas_total
                    FROM detalle_factura df
                    JOIN factura f ON df.fact_id = f.fact_id
                    WHERE f.fact_fecha = '".$calcularBalance[0]."'
                ) AS ventas,
                (
                    SELECT SUM(gas_total) AS gastos_total
                    FROM gastos
                    WHERE gas_fecha = '".$calcularBalance[0]."'
                ) AS gastos;
                ";

              }else{
                $consulta= "SELECT ventas_total AS total_ventas,
                COALESCE(ROUND(gastos_total, 2), 0) AS total_gastos,
                ventas_total - COALESCE(ROUND(gastos_total, 2), 0) AS ganancia_total
                FROM (
                    SELECT SUM(df.dfact_precio) AS ventas_total
                    FROM detalle_factura df
                    JOIN factura f ON df.fact_id = f.fact_id
                    WHERE f.fact_fecha BETWEEN '".$calcularBalance[0]."' AND '".$calcularBalance[1]."'
                ) AS ventas,
                (
                    SELECT SUM(gas_total) AS gastos_total
                    FROM gastos
                    WHERE gas_fecha BETWEEN '".$calcularBalance[0]."' AND '".$calcularBalance[1]."'
                ) AS gastos;";
              }
               
                //$db = mysqli_select_db( $conexion, $nombreBD ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
                $datos= mysqli_query ($conexion,$consulta);
                $resultado =mysqli_fetch_array($datos);
                mysqli_close($conexion);
                
                
            echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
            exit; 
        
    }
  }

//Termina --- Calcular Balance

//Comienza --- Busqueda entre Fechas en Lista de gastos

if(isset($_POST['action']) && $_POST['action'] == 'busqueda_Fecha_Gastos'){
  $busqueda_Fecha_Gastos = $_POST['busqueda_Fecha_Gastos'];
    if(!empty($busqueda_Fecha_Gastos)){  
              include('./../js/bd.php');
                if ($busqueda_Fecha_Gastos[0] !== $busqueda_Fecha_Gastos[1]) {

                $consulta = "SELECT
                ROW_NUMBER() OVER (ORDER BY gas_id) AS numeracion,
                gas_id,
                gas_proveedor,
                gas_fecha,
                gas_concepto,
                gas_total
                FROM
                Gastos where gas_fecha BETWEEN '".$busqueda_Fecha_Gastos[0]."' AND '".$busqueda_Fecha_Gastos[1]."'";
                
                }else {
                $consulta = "SELECT
                ROW_NUMBER() OVER (ORDER BY gas_id) AS numeracion,
                gas_id,
                gas_proveedor,
                gas_fecha,
                gas_concepto,
                gas_total
                FROM
                Gastos where gas_fecha= '".$busqueda_Fecha_Gastos[0]."'";
                }
                

                $datos= mysqli_query ($conexion,$consulta);
                $gastos = array(); // Array para almacenar los objetos de gastos

                while ($fila = mysqli_fetch_array($datos)) {
                    $gas_num = $fila['numeracion'];
                    $gas_id = $fila['gas_id'];
                    $gas_proveedor = $fila['gas_proveedor'];
                    $gas_fecha = $fila['gas_fecha'];
                    $gas_concepto = $fila['gas_concepto'];
                    $gas_total = $fila['gas_total'];

                    $gasto = new stdClass(); // Objeto para almacenar los datos de cada gasto
                    $gasto->gas_num = $gas_num;
                    $gasto->gas_concepto = $gas_concepto;
                    $gasto->gas_proveedor = $gas_proveedor;
                    $gasto->gas_fecha = $gas_fecha;
                    $gasto->gas_total = $gas_total;
                    $gasto->gas_id = $gas_id;

                    $gastos[] = $gasto; // Agregar el objeto de gasto al array

                    // ... Resto del código ...
                }

                mysqli_close($conexion);

                $data = $gastos; // Utilizar el array de gastos como resultado 
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                exit;
                        
              }
  }

//Termina --- Busqueda entre Fechas en Lista de gastos

//Comienza --- Busqueda entre Fechas de Ventas para Balance

if(isset($_POST['action']) && $_POST['action'] == 'busqueda_ventasFechas'){
  $busqueda_ventasFechas = $_POST['busqueda_ventasFechas'];
    if(!empty($busqueda_ventasFechas)){  
    
              include('./../js/bd.php');
                
                if ($busqueda_ventasFechas[0] == $busqueda_ventasFechas[1]) {
                $consulta = "SELECT
                ROW_NUMBER() OVER (ORDER BY factura.fact_id) AS numeracion,
                factura.fact_id,
                factura.fact_fecha,
                total_factura.precioTotal
                FROM
                    Factura factura
                JOIN
                    (SELECT
                        fact_id,
                        SUM(dfact_precio) AS precioTotal
                    FROM
                        Detalle_Factura
                    GROUP BY
                        fact_id) total_factura
                ON
                    total_factura.fact_id = factura.fact_id
                WHERE
                    factura.fact_fecha = '".$busqueda_ventasFechas[0]."'
                ORDER BY
                    numeracion ASC
                ";
                }else {
                  $consulta = "SELECT
                ROW_NUMBER() OVER (ORDER BY factura.fact_id) AS numeracion,
                factura.fact_id,
                factura.fact_fecha,
                total_factura.precioTotal
                FROM
                    Factura factura
                JOIN
                    (SELECT
                        fact_id,
                        SUM(dfact_precio) AS precioTotal
                    FROM
                        Detalle_Factura
                    GROUP BY
                        fact_id) total_factura
                ON
                    total_factura.fact_id = factura.fact_id
                WHERE
                    factura.fact_fecha BETWEEN '".$busqueda_ventasFechas[0]."' AND '".$busqueda_ventasFechas[1]."'
                ORDER BY
                    numeracion ASC
                ";
                }
                

                $datos= mysqli_query ($conexion,$consulta);
                $ventas = array(); // Array para almacenar los objetos de ventas

                while ($fila = mysqli_fetch_array($datos)) {
                    $ventas_num = $fila['numeracion'];
                    $ventas_id = $fila['fact_id'];
                    $ventas_fecha = $fila['fact_fecha'];
                    $ventas_total = $fila['precioTotal'];


                    $venta = new stdClass(); // Objeto para almacenar los datos de cada ventasto
                    $venta->ventas_num = $ventas_num;
                    $venta->ventas_id = $ventas_id;
                    $venta->ventas_fecha = $ventas_fecha;
                    $venta->ventas_total = $ventas_total;

                    $ventas[] = $venta; // Agregar el objeto de gasto al array

                    // ... Resto del código ...
                }

                mysqli_close($conexion);

                $data = $ventas; // Utilizar el array de ventas como resultado 
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                exit;
                        
              }
              
  }

//Termina --- Busqueda entre Fechas de Ventas para Balance

//Comienza --- Busqueda concepto lista_Gastos

if((isset($_POST['action'])) && $_POST['action']=='buscar_conceptoLista__Gastos'){
  //SELECT * FROM articulos WHERE articulos.art_nom LIKE ('%', palabra , '%');
  include('bd.php');
                    
  $consulta ="SELECT
  ROW_NUMBER() OVER (ORDER BY gas_id) AS numeracion,
  gas_id,
  gas_proveedor,
  gas_fecha,
  gas_concepto,
  gas_total
FROM
  Gastos
WHERE
  gas_concepto LIKE '".$_POST['buscar_conceptoLista__Gastos']."%' ORDER BY numeracion ASC;";
  $datos= mysqli_query ($conexion,$consulta);

  $busqueda = new stdClass();
  while ($fila =mysqli_fetch_assoc($datos)){
    echo'
      <tr>
        <th class="col-1 text-center">'.$fila ["numeracion"].'</th>
        <th>'.$fila ["gas_concepto"].'</th>
        <th>'.$fila ["gas_proveedor"].'</th>
        <th class="col-2 text-center">'.$fila ["gas_fecha"].'</th>
        <th class="text-center">$'.$fila ["gas_total"].'</th>
      </tr>';
  }
  exit;
  mysqli_close($conexion);
}

//Termina --- Busqueda concepto lista_Gastos
//Comienza --- Busqueda proveedor lista_Gastos

if((isset($_POST['action'])) && $_POST['action']=='buscar_proveedorLista__Gastos'){
  //SELECT * FROM articulos WHERE articulos.art_nom LIKE ('%', palabra , '%');
  include('bd.php');
                    
  $consulta ="SELECT
  ROW_NUMBER() OVER (ORDER BY gas_id) AS numeracion,
  gas_id,
  gas_proveedor,
  gas_fecha,
  gas_concepto,
  gas_total
FROM
  Gastos
WHERE
  gas_proveedor LIKE '".$_POST['buscar_proveedorLista__Gastos']."%' ORDER BY numeracion ASC;";
  $datos= mysqli_query ($conexion,$consulta);

  $busqueda = new stdClass();
  while ($fila =mysqli_fetch_assoc($datos)){
    echo'
      <tr>
        <th class="col-1 text-center">'.$fila ["numeracion"].'</th>
        <th>'.$fila ["gas_concepto"].'</th>
        <th>'.$fila ["gas_proveedor"].'</th>
        <th class="col-2 text-center">'.$fila ["gas_fecha"].'</th>
        <th class="text-center">$'.$fila ["gas_total"].'</th>
      </tr>';
  }
  exit;
  mysqli_close($conexion);
}

//Termina --- Busqueda proveedor lista_Gastos

//Comienza --- Eliminar imagen seleccionada del articulo

if((isset($_POST['action'])) && $_POST['action']=='eliminar_imgSeleccionada'){
  //SELECT * FROM articulos WHERE articulos.art_nom LIKE ('%', palabra , '%');
  include('bd.php');
                    
  $consulta ="DELETE FROM `art_imagenes` WHERE ruta_img ='".$_POST['eliminar_imgSeleccionada']."'";
  $datos= mysqli_query ($conexion,$consulta) or die($mysqli->error);

  mysqli_close($conexion);
  
  if($datos){
    $data = 'Se eliminó correctamente';
  }else{
    $data= 0;
  }

  echo json_encode($data,JSON_UNESCAPED_UNICODE);
  exit; 
}

//Termina --- Eliminar imagen seleccionada del articulo

//Buscador Lista Articulos

if((isset($_POST['action'])) && $_POST['action']=='buscar_listaArticulos'){
  //SELECT * FROM articulos WHERE articulos.art_nom LIKE ('%', palabra , '%');
  include('bd.php');
  $consulta ="SELECT articulos.*, categorias.*, primera_imagen.ruta_img AS art_imagen
  FROM articulos 
  INNER JOIN categorias ON articulos.art_categoria = categorias.cat_id 
  LEFT JOIN (
    SELECT art_id, ruta_img
    FROM art_imagenes
    GROUP BY art_id
  ) AS primera_imagen ON articulos.art_id = primera_imagen.art_id 
   WHERE articulos.art_nom Like '%".$_POST['buscar_listaArticulos']."%' ORDER BY art_id DESC;";
  $datos= mysqli_query ($conexion,$consulta);

  $busqueda = new stdClass();
  if ($fila = mysqli_num_rows($datos)>0) {
    while ($fila = mysqli_fetch_array($datos)) {
      //<th scope="col-1">'.$i++.'</th>
      echo '
                <tr>
                    <th class="align-middle text-center p-0" >
                      <a role="button" id="imgProducto" class="btn btn-primary" onclick="redireccionArticulo_Imagenes(' . $fila["art_id"] . ')"><i class="bi bi-images"></i></a>
                    </th>
                    <th class="align-middle p-0 text-center">' . $fila["art_id"] . '</th>
                    <th class="align-middle p-0 text-center">' . $fila["art_cod"] . '</th>
                    <th class="align-middle p-0 text-center">' . $fila["art_nom"] . '</th>
                    <th class="align-middle p-0 text-center">$' . $fila["art_precio"] . '</th>
                    <th class="align-middle p-0 text-center">' . $fila["art_stock"] . '</th>
                    <th class="align-middle p-0 text-center">$' . $fila["art_costo"] . '</th>
                    
                    
                    <th class="align-middle p-0 text-center">' . $fila["cat_nom"] . '</th>
                    <th class="align-middle p-0 text-center">' . $fila["art_desc"] . '</th>
                    <th class="align-middle p-0 text-center">' . $fila["art_materiales"] . '</th>
                    <th class="align-middle p-0 text-center">' . $fila["art_notas"] . '</th>
                    <th class="align-middle text-center">
                    
                    <a role="button" id="modificar__Articulo' . $fila["art_id"] . '" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_modificarArticulo" data-art_id=' . $fila['art_id'] . ' >
                    <i class="bi bi-pencil-fill"></i>
                    </a>
                    <a role="button" id="insertarStock' . $fila["art_id"] . '" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_insertarStock" data-art_id=' . $fila['art_id'] . '>
                    <i class="bi bi-plus-circle"></i>
                    </a>
                    <a role="button" id="eliminar__Articulo' . $fila["art_id"] . '" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_eliminarArticulo" data-art_id=' . $fila['art_id'] . '>
                    <i class="bi bi-x-square"></i>
                    </a>
                  </th>
                </tr>';
                
    }
  }else{
   echo 'No se encontraron resultados';
  }
  exit;
  mysqli_close($conexion);
}


//Termina---Buscador Lista Articulos

//Cargar datos al modal InsertarStock
if(isset($_POST['action']) && $_POST['action'] == 'insertarStock'){
  $insertarStock = $_POST['insertarStock'];
    if(!empty($insertarStock)){
      
      include('./../js/bd.php');
      
        $consulta = "SELECT * FROM `articulos` WHERE art_id = ".$insertarStock."";
    
        $datos= mysqli_query ($conexion,$consulta);
        
        $articulo = new stdClass();
        
        mysqli_close($conexion);
        // 4) Ir Imprimiendo las filas resultantes
        while ($fila =mysqli_fetch_array($datos)){
          $art_id = $fila['art_id'];
          $art_nom = $fila['art_nom'];

          $articulo->art_id =$art_id;
          $articulo->art_nom = $art_nom;
          
        }

        if($articulo){
              $data = $articulo;
            }else{
              $data = 0;
            }

            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
        }
      
      }        

//Termina Cargar datos al modal InsertarStock

//Insertar stock con lo recibido del formulario
if(isset($_POST['action']) && $_POST['action'] == 'insertar_cantidadStock'){
  $insertar_cantidadStock = $_POST['insertar_cantidadStock'];
    if(!empty($insertar_cantidadStock[0]) || !empty($insertar_cantidadStock[1]) || !empty($insertar_cantidadStock[2]) || !empty($insertar_cantidadStock[3]) || !empty($insertar_cantidadStock[4])){
      $fechaActual = date('Y-m-d');
      include('./../js/bd.php');
      
      try {
      
      $query_insertarStock = 
      'UPDATE articulos
      SET art_stock = art_stock + '.$_POST["insertar_cantidadStock"][1].'
      WHERE art_id = '.$_POST["insertar_cantidadStock"][0].';';
      $query_insertarGasto = 'INSERT INTO gastos (gas_fecha,gas_concepto, gas_proveedor, gas_total)
      VALUES ("'.$fechaActual.'","'.$_POST["insertar_cantidadStock"][2].'", "'.$_POST["insertar_cantidadStock"][3].'", '.$_POST["insertar_cantidadStock"][4].');';

      $resultado_stock= mysqli_query ($conexion,$query_insertarStock);
      $resultado_gasto= mysqli_query ($conexion,$query_insertarGasto);
      
    } catch (\Throwable $th) {
      $conexion->rollback();
      $data = $conexion->connect_errno;
    }
           
      mysqli_close($conexion);

      if($resultado_stock && $resultado_gasto ){
            $data = 'exito';
          }else{
            $data = $conexion->connect_errno;
          }

          echo json_encode($data,JSON_UNESCAPED_UNICODE);
          exit;
        }else{
          echo json_encode('error',JSON_UNESCAPED_UNICODE);
          exit;
        }
    
    }        

//Termina --- Insertar stock con lo recibido del formulario

?>