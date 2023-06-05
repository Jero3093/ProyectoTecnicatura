
<?php

$idFactura;
$categoriasCargadas = new stdClass();

function comprobarUsuario()
{
  if (isset($_SESSION['usuarioActivo']) && $_SESSION['usu_rol'] == 1) {
    // header('location: ./../maderastablas/principal.php');
  } elseif (isset($_SESSION['usuarioActivo']) && $_SESSION['usu_rol'] > 1) {
    header('location: ./../ecommerce/index.php');
  } else {
    header('location: ./../maderastablas/index.php');
  }
}


function mostrarArticulos()
{
  include('./../assets/js/bd.php');
  // 2) Preparar la orden SQL
  $consulta = "SELECT * FROM articulos INNER JOIN categorias on articulos.art_categoria = categorias.cat_id ORDER BY art_id DESC";

  // puedo seleccionar de DB
  $db = mysqli_select_db($conexion, $nombreBD) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");

  // 3) Ejecutar la orden y obtener datos
  $datos = mysqli_query($conexion, $consulta);

  // 4) Ir Imprimiendo las filas resultantes
  $i = 1;
  if ($fila = mysqli_num_rows($datos) > 0) {
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
  } else {
    echo 'No se encontraron resultados..';
  }

  mysqli_close($conexion);
}
function mostrarArticulos_Ecommerce()
{
  include('./../assets/js/bd.php');
  // 2) Preparar la orden SQL
  $consulta = "SELECT articulos.*, categorias.*, primera_imagen.ruta_img AS art_imagen
  FROM articulos 
  INNER JOIN categorias ON articulos.art_categoria = categorias.cat_id 
  LEFT JOIN (
    SELECT art_id, ruta_img
    FROM art_imagenes
    GROUP BY art_id
  ) AS primera_imagen ON articulos.art_id = primera_imagen.art_id
  ORDER BY articulos.art_id DESC;
  ";

  // puedo seleccionar de DB
  $db = mysqli_select_db($conexion, $nombreBD) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");

  // 3) Ejecutar la orden y obtener datos
  $datos = mysqli_query($conexion, $consulta);

  // 4) Ir Imprimiendo las filas resultantes

  if ($fila = mysqli_num_rows($datos) > 0) {
    while ($fila = mysqli_fetch_array($datos)) {
      //<th scope="col-1">'.$i++.'</th>
      echo '<div class="ProductsList_Card" id="art_Ecommerce" onclick="redireccionArticulo(' . $fila["art_id"] . ')">
              <div class="contain-imgCard">
                <img src="';
      if (!empty($fila['art_imagen'])) {
        echo '' . $fila["art_imagen"] . '" alt="error al cargar imagen" class="ProductsList_Card-Img">
              </div>
              <div class="ProductsList_Card-Content">
                <span class="ProductsList_Card-Cat">' . $fila["cat_nom"] . '</span>
                  <div class="ProductsList_Card-Name_Container">
                    <h5 class="ProductsList_Card-Name">' . $fila["art_nom"] . '</h5>
                  </div>
                <div class="text-center"> Disponibles: <span style="color: red; font-size: large;">' . $fila["art_stock"] . '</span> </div>
                <h4 class="ProductsList_Card-Price">$' . $fila["art_precio"] . '</h4>
              </div>
            </div>';
      } else {
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
  } else {
    echo 'No se encontraron resultados';
  }


  mysqli_close($conexion);
}


function cargarCategorias()
{
  include('./../assets/js/bd.php');
  $consulta = "SELECT `cat_id`, `cat_nom`, `cat_obs` FROM `categorias` ORDER BY cat_nom";

  //$db = mysqli_select_db( $conexion, $nombreBD) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

  $datos = mysqli_query($conexion, $consulta);

  if ($datos) {
    $categoriasCargadas = new stdClass();
    // 4) Ir Imprimiendo las filas resultantes
    while ($fila = mysqli_fetch_array($datos)) {
      $id[] = $fila[0];
      $nombre[] = $fila[1];

      $categoriasCargadas->id = $id;
      $categoriasCargadas->nombre = $nombre;

      echo '<option class="text-center" value="' . $fila[0] . '">' . $fila[1] . '</option>';
    }
  }
  mysqli_close($conexion);
}

//Buscar articulos en ...

if (isset($_POST['idAction']) && $_POST['idAction'] == 'searchIdArticulo') {
  if (!empty($_POST['idArticulo'])) {
    include('./../assets/js/bd.php');
    $consulta = "SELECT * FROM `articulos` WHERE id_articulo=" . $_POST['idArticulo'] . "";
    $db = mysqli_select_db($conexion, $nombreBD) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");

    $datos = mysqli_query($conexion, $consulta);

    $articulo = new stdClass();

    // 4) Ir Imprimiendo las filas resultantes
    while ($fila = mysqli_fetch_array($datos)) {
      $id = $fila['id_articulo'];
      $precio = $fila['precio'];
      $cantidad = $fila['cantidad'];

      $articulo->id = $id;
      $articulo->precio = $precio;
      $articulo->cantidad = $cantidad;
    }


    mysqli_close($conexion);

    if ($articulo) {
      $dataId = $articulo;
    } else {
      $dataId = 0;
    }
    echo json_encode($articulo, JSON_UNESCAPED_UNICODE);
  }
}
/* 
if (isset($_POST['action']) && $_POST['action'] == 'procesarVenta') {

  $formated_DATE = date('Y-m-d');

  include('./../assets/js/bd.php');
  $consulta = "SELECT max(noFactura) FROM `facturas`";
  $db = mysqli_select_db($conexion, $nombreBD) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");


  $datos = mysqli_query($conexion, $consulta);

  if ($datos !== 0) {
    $resultado = mysqli_fetch_assoc($datos);
    $idFactura = $resultado['max(noFactura)'];

    if ($idFactura > 0) {

      $arrayVenta = $_POST['detalleF'];
      for ($i = 0; $i < count($arrayVenta); $i++) {
        echo "<br>";
        include('./../assets/js/bd.php');
        $consulta = "INSERT INTO `detalle_factura`(`nroRenglon`, `id_factura`, `id_articulo`, `cantidad`, `precio`) VALUES (" . $arrayVenta[$i]['nroRenglon'] . "," . $idFactura . "," . $arrayVenta[$i]['id_articulo'] . "," . $arrayVenta[$i]['cantidad'] . "," . $arrayVenta[$i]['precioTotal'] . ")";

        $db = mysqli_select_db($conexion, $nombreBD) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");
        $datos = mysqli_query($conexion, $consulta);

        mysqli_close($conexion);
      }
      $data='<div class="alert alert-success text-center" role="alert">generando factura!..</div>';
      echo json_encode($data,JSON_UNESCAPED_UNICODE);
    } else {
      $data='<div class="alert alert-danger text-center" role="alert">no se pudo!..</div>';
      echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    exit;
  }



  ///////////
}
 */

////////------------------------------////////////////



// función sql que muestra las facturas
function mostrarFacturas()
{
  include('./../assets/js/bd.php');

  /* $consulta= "SELECT factura.fact_id ,factura.fact_fecha ,sum(dfact_precio) as precioTotal from detalle_factura INNER JOIN factura on detalle_factura.fact_id = factura.fact_id  GROUP BY fact_id ORDER BY fact_id DESC"; */
  $consulta = 'call mostrar_Facturas()';
  $datos = mysqli_query($conexion, $consulta);


  $i = 1;
  while ($fila = mysqli_fetch_array($datos)) {
    //<th scope="col-1">'.$i++.'</th>

    echo '
  <tr>
      <th class="text-center">' . $fila["fact_id"] . '</th>
      <th class="text-center">' . $fila["fact_fecha"] . '</th>
      <th class="text-center">$' . $fila["precioTotal"] . '</th>
  <th class="align-middle text-center">
    <a role="button" id="imprimir_Factura' . $fila["fact_id"] . '" class="btn btn-primary" data-fact_id=' . $fila['fact_id'] . '>
    <i class="bi bi-printer-fill"></i>
    </a>
  </th>
</tr>';
  }


  mysqli_close($conexion);
}
//Termina---función sql que muestra las facturas

// función sql que muestra los gastos
function mostrarGastos()
{
  include('./../assets/js/bd.php');

  $consulta = "call mostrar_Gastos()";

  $datos = mysqli_query($conexion, $consulta);


  $i = 1;
  while ($fila = mysqli_fetch_array($datos)) {
    //<th scope="col-1">'.$i++.'</th>

    echo '
                      <tr>
                          <th class="col-1 text-center">' . $fila["numeracion"] . '</th>
                          <th>' . $fila["gas_concepto"] . '</th>
                          <th>' . $fila["gas_proveedor"] . '</th>
                          <th class="col-2 text-center">' . $fila["gas_fecha"] . '</th>
                          <th class="text-center">$' . $fila["gas_total"] . '</th>
                      </tr>';
  }


  mysqli_close($conexion);
}
//Termina---función sql que muestra los gastos

//Comienza---mostrar articulo seleccionado

function mostrarArticuloSeleccionado()
{
  if (isset($_GET['articleID'])) {
    //echo $_GET['articleID'];
    include('./../assets/js/bd.php');
    // 2) Preparar la orden SQL
    $consulta = "SELECT * FROM articulos INNER JOIN categorias on articulos.art_categoria = categorias.cat_id where art_id = " . $_GET['articleID'] . "";

    $consultaIMG = 'SELECT ruta_img
            FROM articulos
            INNER JOIN art_imagenes ON articulos.art_id = art_imagenes.art_id
            WHERE articulos.art_id = "' . $_GET['articleID'] . '" LIMIT 999999 OFFSET 0';

    $consultaPrimer_img = 'SELECT ruta_img
            FROM articulos
            INNER JOIN art_imagenes ON articulos.art_id = art_imagenes.art_id
            WHERE articulos.art_id = "' . $_GET['articleID'] . '" LIMIT 1';

    // 3) Ejecutar la orden y obtener datos
    $datos = mysqli_query($conexion, $consulta);
    $datosIMG = mysqli_query($conexion, $consultaIMG);
    $datosPrimer_img = mysqli_query($conexion, $consultaPrimer_img);

    $fila = mysqli_fetch_array($datos);
    $filaIMG = mysqli_fetch_array($datosIMG);
    $filaPrimer_IMG = mysqli_fetch_array($datosPrimer_img);

    if ($filaPrimer_IMG) {
      echo '
      <!--Product Content-->
      <main class="ProductDetails">
          <div id="carouselExampleAutoplaying" class="carousel slide ProductDetails_Main" data-bs-ride="carousel">
              <div class="carousel-inner">
                  <div class="carousel-item active">
                      <img src="' . $filaPrimer_IMG['ruta_img'] . '" class="ProductDetails_Main-Img " alt="...">
                  </div>';
      while ($imagenRecibida = mysqli_fetch_array($datosIMG)) {
        echo ' 
                        <div class="carousel-item">
                            <img src="' . $imagenRecibida['ruta_img'] . '" class="ProductDetails_Main-Img" alt="...">
                        </div>';
      }

      echo '
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
              </button>
          </div>
          </div>
          <div class="ProductDetails_Main-Content">
              <p class="ProductDetails_Main-Category">' . $fila["cat_nom"] . '</p>
              <p class="ProductDetails_Main-Name">' . $fila["art_nom"] . '</p>
              <p class="ProductDetails_Main-Description">' . $fila["art_desc"] . '</p>
              <p class="ProductDetails_Main-Price">$' . $fila["art_precio"] . '</p>
              <p class="ProductDetails_Main-Price">Stock:' . $fila["art_stock"] . '</p>
              <a href="https://wa.me/573001112233?text=Hola!%20Estoy%20interesado%20en%20'.$fila["art_nom"].'" class="ProductDetails_Main-Button" target="_blank">
                  Consultar Producto
              </a>
          </div>
      </main>';
    } else {
      echo '
    <!--Product Content-->
    <main class="ProductDetails">
        <div id="carouselExampleAutoplaying" class="carousel slide ProductDetails_Main" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./../assets/images/default.png" class="ProductDetails_Main-Img " alt="...">
                </div>';

      echo '</div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        </div>
        <div class="ProductDetails_Main-Content">
            <p class="ProductDetails_Main-Category">' . $fila["cat_nom"] . '</p>
            <p class="ProductDetails_Main-Name">' . $fila["art_nom"] . '</p>
            <p class="ProductDetails_Main-Description">' . $fila["art_desc"] . '</p>
            <p class="ProductDetails_Main-Price">$' . $fila["art_precio"] . '</p>
            <p class="ProductDetails_Main-Price">Stock:' . $fila["art_stock"] . '</p>
            <a href=https://wa.me/573001112233?text=Hola!%20Estoy%20interesado%20en%20'.$fila["art_nom"].' class="ProductDetails_Main-Button" target="_blank">
                Consultar Producto
            </a>
        </div>
    </main>';
    }
    mysqli_close($conexion);
  }
}
//Termina--- mostrar articulo seleccionado

//Empieza --- Mostar Carrousel de Articulos de Misma Categoria
function mostrarArticulosMismaCategoria()
{
  if (isset($_GET['articleID'])) {
    include('./../assets/js/bd.php');
    // 2) Preparar la orden SQL
    $art_categoria = 'SELECT art_categoria FROM `articulos` WHERE art_id = "' . $_GET["articleID"] . '" ';

    $query_categoria = mysqli_query($conexion, $art_categoria);

    $resultado_categoria = mysqli_fetch_array($query_categoria);

    $query_relacionados = 'SELECT a.*, primera_imagen.ruta_img
    FROM articulos a
    INNER JOIN categorias c ON c.cat_id = a.art_categoria
    LEFT JOIN (
        SELECT art_id, ruta_img
        FROM art_imagenes
        GROUP BY art_id
    ) AS primera_imagen ON a.art_id = primera_imagen.art_id
    WHERE c.cat_id = ' . $resultado_categoria[0] . '
    AND a.art_id <> "' . $_GET['articleID'] . '"
    AND a.art_id NOT IN (
        SELECT art_id
        FROM articulos
        WHERE art_categoria = ' . $resultado_categoria[0] . '
        AND art_id = "' . $_GET['articleID'] . '"
    )
    ORDER BY a.art_id DESC;';


    $articulos_relacionados = mysqli_query($conexion, $query_relacionados);
    $contadorFilas = mysqli_num_rows($articulos_relacionados);


    if ($contadorFilas > 0) {
      while ($art_rel = mysqli_fetch_array($articulos_relacionados)) {

        echo '
        <div class="ProductsList_Card" id="art_Ecommerce" onclick="redireccionArticulo(' . $art_rel["art_id"] . ')">
          <div class="contain-imgCard">
            <img src="';
        if (!empty($art_rel['ruta_img'])) {
          echo '' . $art_rel["ruta_img"] . '" alt="error al cargar imagen" class="ProductsList_Card-Img">
          </div>
          <div class="ProductsList_Card-Content">
            <span class="ProductsList_Card-Cat"></span>
              <div class="ProductsList_Card-Name_Container">
                <h5 class="ProductsList_Card-Name">' . $art_rel["art_nom"] . '</h5>
              </div>
            <h4 class="ProductsList_Card-Price">$' . $art_rel["art_precio"] . '</h4>
          </div>
        </div>';
        } else {
          echo
          './../assets/images/default.png" alt="error al cargar imagen" class="ProductsList_Card-Img"></div>
            <div class="ProductsList_Card-Content">
                <span class="ProductsList_Card-Cat">' . $art_rel["art_categoria"] . '</span>
                <div class="ProductsList_Card-Name_Container">
                  <h5 class="ProductsList_Card-Name">' . $art_rel["art_nom"] . '</h5>
                </div>
              <h4 class="ProductsList_Card-Price">$' . $art_rel["art_precio"] . '</h4>
            </div>
          </div>';
        }
      }
    }

    mysqli_close($conexion);
  }
}
//Termina --- Mostar Carrousel de Articulos de Misma Categoria



//Comienza --- cargar imagenes en subir imagen segun id articulo

function imagenes_articuloSeleccionado()
{
  if (isset($_GET['img_articleID'])) {

    include('./../assets/js/bd.php');
    // 2) Preparar la orden SQL
    $consulta = "SELECT * FROM articulos
            INNER JOIN art_imagenes ON articulos.art_id = art_imagenes.art_id
            WHERE articulos.art_id = " . $_GET['img_articleID'] . "";

    // puedo seleccionar de DB
    $db = mysqli_select_db($conexion, $nombreBD) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");

    // 3) Ejecutar la orden y obtener datos
    $datos = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($datos) == 0) {
      echo '<div style="
      display: flex;
      margin: auto;
      font-size: 20px;"> No se encontraron imágenes </div>';
    } else {
      $contador = 1;
      while ($fila = mysqli_fetch_array($datos)) {
        $ruta_img = $fila['ruta_img'];
        echo '
          <div class="AddProductImage_Carrousel-Card">
              <img src="' . $ruta_img . '" class="AddProductImage_Carrousel-Card-Img" />
              <button id="btn_eliminarImagen_Seleccionada' . $contador . '" type="button" class="AddProductImage_Carrousel-Card-Button"  data="' . $ruta_img . '" />
                <img src="../assets/icons/basura.png" class="AddProductImage_Carrousel-Card-Button-Icon" />
              </button>
          </div>';
        $contador = $contador + 1;
      }
    }

    mysqli_close($conexion);
  }
}
//







?>
