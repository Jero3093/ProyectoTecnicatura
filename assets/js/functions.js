let imgProductoID;
let i = 1;
let art_id;
//Ir a la pagina anterior
function irPaginaAnterior() {
    history.back();
}
//Validacion de boton "ingresar articulo nuevo"
let verificacion_codigoArt ;
let verificacion_nombreArt ;
//Parte FACTURACIÓN--->
let id_articuloAgregar;
let nombre_articuloAgregar;
let cantidad_articuloAgregar;
let precio_articuloAgregar;

let precioArticulo;
//Parte eliminar img seleccionada
function eliminar_imgSeleccionada(objet) {
    
     let dataValue = $(objet).attr('data');
     let action = 'eliminar_imgSeleccionada';
    console.log('esto es '+dataValue);
    $.ajax({
        url: './../assets/js/ajax.php',
        type: "POST",
        async: true,
        data: { action: action, eliminar_imgSeleccionada : dataValue },


        success: function (response) {
            console.log(response);
            //data = $.parseJSON(response);
           
            if (response !== 0) {
                location.reload();
            } else {
                alert("Hubo un error al eliminar");
            }


        },
        error: function (error) {

        }
    }); 
   
}
$(".AddProductImage_Carrousel-Card-Button").click(function() {
    var boton = $(this);
    var ruta_img = boton.attr("data");
    eliminar_imgSeleccionada(boton);
  });

//Parte balance - fechas
let fechaInicio = $("#date_Inicio-balance");
let fechaFinal = $("#date_Final-balance");

//Parte subir imagenes
function subirImagen_articulo(){
    let parametros = new FormData($('#form_subirImagenes')[0]);
    let idArt_imagen = $('#recibeID').html();
    parametros.append('idArt_imagen', idArt_imagen);
   
    $.ajax({
        data:parametros,
        url: './../assets/js/ajax.php',
        type: "POST",
        contentType: false,
        processData: false,
        beforesend: function(response) {
        },
        success: function(response) {
            alert('Se subieron las fotos correctamente');
            location.reload();
        }
    })
}


function mostrarLista_gastosFechas_parametros(fecha1,fecha2) {
    fechaInicio.datepicker({
        dateFormat: "yy-mm-dd",
        showButtonPanel: false,
        onSelect: function (selectedDate) {
            // Establecer la fecha máxima permitida en el datepicker de fecha final
            fechaFinal.datepicker("option", "minDate", selectedDate);
        }
    });

    let arrayFechas = [];
    arrayFechas.push(fecha1, fecha2);
    

    let action = 'busqueda_Fecha_Gastos';
    $.ajax({
        url: './../assets/js/ajax.php',
        type: "POST",
        async: true,
        data: { action: action, busqueda_Fecha_Gastos: arrayFechas },

        success: function (response) {
            let data = $.parseJSON(response);
            const celdas = [];
            if (data.length > 1) {
                $('#recibeResultados_Gastos').html('');
                $.each(data, function(index, objeto) {
                    const fila = `
                      <tr>
                        <th>${objeto.gas_num}</th>
                        <th>${objeto.gas_concepto}</th>
                        <th>${objeto.gas_proveedor}</th>
                        <th>${objeto.gas_fecha}</th>
                        <th class='text-danger'>$${objeto.gas_total}</th>
                      </tr>
                    `;
                    
                    // Mostrar la fila en la tabla
                    
                    $('#recibeResultados_Gastos').append(fila);
                  });

            } else {
                $('#recibeResultados_Gastos').html("No se encontraron resultados");
            }


        },
        error: function (error) {
        }
    });
}

function mostrarLista_ventasFechas_parametros(fecha1,fecha2) {
    
    fechaInicio.datepicker({
        dateFormat: "yy-mm-dd",
        showButtonPanel: false,
        onSelect: function (selectedDate) {
            // Establecer la fecha máxima permitida en el datepicker de fecha final
            fechaFinal.datepicker("option", "minDate", selectedDate);
        }
    });

    let arrayFechas = [];
    arrayFechas.push(fecha1, fecha2);
    

    let action = 'busqueda_ventasFechas';
        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, busqueda_ventasFechas: arrayFechas },

        success: function (response) {
            
           let data = $.parseJSON(response);
           
            const celdas = [];
            if (data.length>1) {
                
                $('#recibeResultados_Ventas').html('');
                $.each(data, function(index, objeto) {
                    const ventas = `
                      <tr>
                        <th>${objeto.ventas_num}</th>
                        <th>${objeto.ventas_id}</th>
                        <th>${objeto.ventas_fecha}</th>
                        <th class='text-success'>$${objeto.ventas_total}</th>
                      </tr>
                    `;
                    
                    // Mostrar la ventas en la tabla
                    
                    $('#recibeResultados_Ventas').append(ventas);
                  });

            } else{
                $('#recibeResultados_Ventas').html('No se encontraron resultados');
            }

            

        },
        error: function (error) {
        }
    
    });
    
}
function mostrarLista_gastosFechas() {
    fechaInicio.datepicker({
        dateFormat: "yy-mm-dd",
        showButtonPanel: false,
        onSelect: function (selectedDate) {
            // Establecer la fecha máxima permitida en el datepicker de fecha final
            fechaFinal.datepicker("option", "minDate", selectedDate);
        }
    });

    let arrayFechas = [];
    let inicio = $("#date_Inicio-Gastos").val();
    let final = $("#date_Final-Gastos").val();
    arrayFechas.push(inicio, final);
    

    let action = 'busqueda_Fecha_Gastos';
    $.ajax({
        url: './../assets/js/ajax.php',
        type: "POST",
        async: true,
        data: { action: action, busqueda_Fecha_Gastos: arrayFechas },

        success: function (response) {
            let data = $.parseJSON(response);
            
            const celdas = [];
            if (data.length > 1) {
                $('#recibeListado_Gastos').html('');
                $.each(data, function(index, objeto) {
                    const fila = `
                      <tr>
                        <th>${objeto.gas_num}</th>
                        <th>${objeto.gas_concepto}</th>
                        <th>${objeto.gas_proveedor}</th>
                        <th>${objeto.gas_fecha}</th>
                        <th>$${objeto.gas_total}</th>
                      </tr>
                    `;
                    
                    // Mostrar la fila en la tabla
                    
                    $('#recibeListado_Gastos').append(fila);
                  });

            } else {
                $('#recibeListado_Gastos').html('No se encontraron resultados');
            }

            

        },
        error: function (error) {
        }
    });
}

function buscar_proveedorLista__Gastos(text){
    let action = 'buscar_proveedorLista__Gastos';
    if (text.length >= 0) {
        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, buscar_proveedorLista__Gastos: text },

            success: function (response) {
                $('#recibeListado_Gastos').html('');
                //let resultado = $.parseJSON(response);
                if (response) {
                    $('#recibeListado_Gastos').html(response);
                } else {

                    $('#recibeListado_Gastos').html('No se encontraron Resultados');
                   
                }

            },
            error: function (error) {
            }
        });
    } else {

    }
}
function buscar_conceptoLista__Gastos(text){
    let action = 'buscar_conceptoLista__Gastos';
   //let buscar = $("#txt_searchConcepto").val();
    if (text.length >= 0) {
        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, buscar_conceptoLista__Gastos: text },

            success: function (response) {
                $('#recibeListado_Gastos').html('');
                //let resultado = $.parseJSON(response);
                if (response) {
                    $('#recibeListado_Gastos').html(response);
                } else {

                    $('#recibeListado_Gastos').html('No se encontraron Resultados');
                    
                }

            },
            error: function (error) {
            }
        });
    } else {

    }
}
function obtenerPrimerDiaDelMes() {
    var fechaActual = new Date();
    var primerDia = new Date(fechaActual.getFullYear(), fechaActual.getMonth(), 1);

    var year = primerDia.getFullYear();
    var month = ('0' + (primerDia.getMonth() + 1)).slice(-2);
    var day = ('0' + primerDia.getDate()).slice(-2);

    var fechaFormateada = year + '-' + month + '-' + day;
    return fechaFormateada;
}



function redireccionArticulo(id) { //funcion de redireccion de articulos
    window.location.href = './../ecommerce/articulo.php?articleID=' + id;
}
function redireccionArticulo_Imagenes(id) { //funcion de redireccion de articulos
    window.location.href = './../maderastablas/articulo_imagenes.php?img_articleID=' + id;
}
function vaciarCampos() {
    let vacio = '';
    found = false;
    $("#txt_descripcion").html(vacio);
    $("#th_id_articulo").html(vacio);
    $("#th_precio").html(vacio);
    $("#txt_Stock").val(vacio);
    $("#txt_precioTotal").html(vacio);
}
//Parte FACTURACIÓN<---

//función que limpia los campos de agregar producto a factura
function limpiarCamposArt() {
    $('#th_id_articulo').html('');
    $('#txt_descripcion').val('');
    $('#th_precio').html('');
    $('#txt_Cantidad').val('');
    $('#txt_Stock').val('');
    $('#txt_precioTotal').val('');

}
//Termina---función que limpia los campos de agregar producto a factura
$(function () {

    //Boton que anula la compra
    $('#btnAnularCompra').click(function () {
        window.location.href = "./principal.php";
    });
    //Termina---Boton que anula la compra

    //Boton que modifica el articulo en modal
    $("#modalModificar").click(function (e) {
        e.preventDefault();
     
        let arrModificar = [];
        let id = art_id;
        let categoria = $('#modal_modificiarArticulo__Categoria').val();
        let nombre = $('#modalArt__modificarNombre').val();
        let precio = $('#modalArt__modificarPrecio').val();
        let stock = $('#modalArt__modificarStock').val();
        let costo = $('#modalArt__modificarCosto').val();
        let descripcion = $('#modalArt__modificarDescripcion').val();
        let materiales = $('#modalArt__modificarMateriales').val();
        let notas = $('#modalArt__modificarNotas').val();

        arrModificar.push(id, categoria, nombre, precio, stock, costo, descripcion, materiales,notas);



        let action = 'modalModificar_Articulo'

        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, modalModificar_Articulo: arrModificar },


            success: function (response) {


                if (response == 0) {
                    alert('Húbo un error al modificar');
                }
                data = $.parseJSON(response);
               
                if (data == 1) {
                    location.reload();
                }


            },
            error: function (error) {

            }
        });

    });

    //Termina---Boton que modifica el articulo en modal

    //MODAL FORMULARIO MODIFICAR POR ID

    let imagenActual;
    $("[id^='modificar__Articulo']").click(function (e) {
        e.preventDefault();
        art_id = $(this).attr('data-art_id');

        

        let action = 'modificarArticulo';

        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, modificar__Articulo: art_id },


            success: function (response) {


                if (response == 0) {
                    
                }
                let data = $.parseJSON(response);
                
                let innerHTML = `
                <form action="articulos.php" method="post" class="col-12">
                
                <div class="row">
                
                    <div class="col-12">
                        <label for="modalArt__modificarNombre" class="form-label" >Nombre:</label>
                        <input type="text" class="form-control" name="modalArt__modificarNombre" id="modalArt__modificarNombre" value="${data.art_nom}">
                    </div>
                
                    <div class="col-3">
                        <label for="precioArticulo" class="form-label">Precio:</label>
                        <input type="number" class="form-control" name="precioArticulo" id="modalArt__modificarPrecio" value="${data.art_precio}" required>
                    </div>

                    <div class="col-3">
                        <label for="cantidadArticulo" class="form-label">Stock:</label>
                        <input type="number" class="form-control" name="cantidadArticulo" id="modalArt__modificarStock" value="${data.art_stock}" required>
                    </div>
                
                    <div class="col-6">
                        <label for="costoCreacionArticulo" class="form-label">Costo de creación:</label>
                        <input type="number" class="form-control" name="costoCreacionArticulo" id="modalArt__modificarCosto" value="${data.art_costo}">
                    </div>
                </div>
                
                
                
                <div class="row p-2">

                    <label class="form-label" for="descripcionArticulo" >Descripcion:</label>
                    <textarea class="form-control" name="descripcionArticulo" rows="4" cols="50" id="modalArt__modificarDescripcion">${data.art_desc}</textarea>
                    <label class="form-label" for="notasArticulo" >Notas:</label>
                    <textarea class="form-control" name="notasArticulo" rows="4" cols="50" id="modalArt__modificarNotas">${data.art_notas}</textarea>
                    <label class="form-label" for="MaterialesArticulo">Materiales:</label>
                    <textarea class="form-control" name="MaterialesArticulo" rows="4" cols="50" id="modalArt__modificarMateriales">${data.art_materiales}</textarea>

                
                </div>
                
                </form>
                `;

                imagenActual = data.art_imagen;


                //$("#selectedId option : selected").val(data.categoria);
                $('select option[value=' + data.art_categoria + ']').attr("selected", true);
               
                $('.cargaModal').html(innerHTML);
                $('#categoria').html(data.cat_nom);




            },
            error: function (error) {

            }
        });

    });
    //Termina - MODAL FORMULARIO MODIFICAR POR ID

    //Botón de ingresar nuevo Artículo
    //$('#btn__ingresarArticulo').addClass('disabled');
    $("#btn__ingresarArticulo").click(function (e) {
        e.preventDefault();
        if (verificacion_codigoArt == 'no' && verificacion_nombreArt == 'no') {
            let producto = [];
        let codigo = $('#txt__codArticulo').val();
        let nombre = $('#txt__nombreArticulo').val();
        let categoria = $('#select__categoria').val();
        let precio = $('#txt__precioArticulo').val();
        let stock = $('#txt__cantidadArticulo').val();
        let costo = $('#txt__costoCreacionArticulo').val();
        let descripcion = $('#txt__descripcionArticulo').val();
        let materiales = $('#txt__materialesArticulo').val();
        let proveedor = $('#txt__proveedor').val();
        let concepto = $('#txt__provConcepto').val();
        let gastoTotal = $('#txt__gastoTotal').val();

        producto.push(codigo, nombre, descripcion, precio, stock, costo, categoria, materiales, proveedor, concepto, gastoTotal);

        let action = 'nuevoArticulo'

        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, nuevoArticulo: producto },


            success: function (response) {

                data = $.parseJSON(response);

                if (data == 'error') {
                    alert('Húbo un error al ingresar nuevo producto');
                } else if (data == 'exito') {
                    alert('Articulo ingresado con exito');
                    location.reload();

                } else if (data == 'dato duplicado') {
                    alert('Ya existe un articulo con ese ID');
                } else if (data == 'Faltan datos') {
                    alert('Complete campos obligatorios');
                }

            },
            error: function (error) {

            }
        });
        }else{
            alert('Verifique que estén correctos los campos');
        }
        

    });
    //Termina - Botón de nuevo Artículo

    //MODAL FORMULARIO ELIMINAR POR ID
    $("[id^='eliminar__Articulo']").click(function (e) {
        e.preventDefault();
        art_id = $(this).attr('data-art_id');
      

        let action = 'eliminarArticulo';

        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, eliminar__Articulo: art_id },


            success: function (response) {


                if (response == 0) {
                    
                }
                let data = $.parseJSON(response);
                
                let innerHTML = `
                <h4 class="text-center m-5"> ¿Seguro desea eliminar ${data}? </h4> 
                `
                $('#datos_modalEliminar').html(innerHTML);



            },
            error: function (error) {

            }
        });

    });
    //Termina - MODAL FORMULARIO ELIMINAR POR ID

    //Boton que ELIMINA ARTICULO EN MODAL
    $("#modalEliminar").click(function (e) {
        e.preventDefault();

        let action = 'modalEliminar_Articulo'

        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, modalEliminar_Articulo: art_id },


            success: function (response) {


                if (response == 0) {
                    alert('Húbo un error al Eliminar');
                }
                data = $.parseJSON(response);
               
                if (data == true) {
                    location.reload();
                } else {
                    alert('Húbo un error al Eliminar');
                }


            },
            error: function (error) {

            }
        });

    });

    //Termina---Boton que ELIMINA ARTICULO EN MODAL

    //Botón que agrega nueva categoría (Articulos)
    $("#modalnuevaCategoria").click(function (e) {
        e.preventDefault();

        arrayCat = [];
        arrayCat.push($('#txt__nombre_nuevaCategoria').val());
        arrayCat.push($('#txt__observacion_nuevaCategoria').val());


        let action = 'modalnueva_Categoria'

        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, modalnueva_Categoria: arrayCat },


            success: function (response) {

                data = $.parseJSON(response);

                if (data == 0) {
                    alert('Húbo un error al Agregar categoría');
                }
                if (data == 'exito') {
                    location.reload();
                  
                }


            },
            error: function (error) {

            }
        });

    });

    //Termina---Botón que agrega nueva categoría (Articulos)

    //Cambiar imagen producto
    var id_imagenCambiar;
    $("[id^='imgProducto']").click(function (e) {
        e.preventDefault();
        imgProductoID = $(this).attr('data-art_id');

        let action = 'cambiar__imgProducto';

        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, cambiar__imgProducto: imgProductoID },

            success: function (response) {

                if (response == 0) {
                   
                }
                let data = $.parseJSON(response);


                let innerHTML = `
                
                <h4>Imagen actual:</h4>
                <div class="col-auto text-center">
                <img src="${data.art_imagen}" alt="Error al cargar imagen" height="280" data-art_id='' id='image_gallery'> 
                </div>
                `;
                id_imagenCambiar = data.art_id;

                $('#datos_modalProductoIMG').html(innerHTML);
                $('#idarticuloIMG').html(id_imagenCambiar);

                $('#formFile').attr("value", data.art_imagen);

               

                $('#formFile').change(function (e) {

                   

                });
                $('#cancelar_cambiarImagen').click(function (e) {


                    data.art_id = '';
                    

                });
                $('.btn-close').click(function (e) {

                    data.art_id = '';
                    

                });


            },
            error: function (error) {

            }
        });

    });

    //Boton que cambia imagen

    $('#archivo').change(function (e) {
        
        let newStr = $('#archivo').val().slice(12);
        $('#recibeNombre_img').val(newStr);
       
    });

    $("#form_cambiarImagen").on("submit", function (e) {
        e.preventDefault();
        var f = $(this);

        var formData = new FormData(document.getElementById("form_cambiarImagen"));
        formData.append("dato", "valor");
        formData.append('idArticulo', id_imagenCambiar);


        $.ajax({
            url: "./../assets/js/ajax.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function (response) {
                if (response) {
                    location.reload();
                    
                } else {
                    
                }
            }
        })


    });


    //Termina---Boton que cambia imagen

    //Termina---Cambiar imagen producto

    //Buscar articulo por nombre en FACTURACIÓN

    $('#txt_descripcion').keyup(function (e) {
        e.preventDefault();

        //let art = ($('#txt_descripcion').val()).trim();
        let art = $('#txt_descripcion').val();
        
        let articulo = art.trim();
        let action = 'searchArticulo';

        if (art.length > 0) {
            $.ajax({
                url: './../assets/js/ajax.php',
                type: "POST",
                async: true,
                data: { action: action, articulo: articulo },


                success: function (response) {


                    if (response == 0) {
                        

                    } else {
                        var data = JSON.parse(response);
                        //var data = JSON.parse(response); 
                        let datosCargar = data;

                       

                        $("#txt_descripcion").autocomplete({
                            source: datosCargar.nombre
                        });


                        $("#txt_descripcion").change(function (e) {
                            e.preventDefault();
                            art = ($('#txt_descripcion').val());
                            if (!art == '') {
                                articulo = art.trim();
                                action = 'searchArticulo';
                                $.ajax({
                                    url: './../assets/js/ajax.php',
                                    type: "POST",
                                    async: true,
                                    data: { action: action, articulo: articulo },


                                    success: function (response) {


                                        if (response == 0) {
                                            

                                        } else {

                                            let data = $.parseJSON(response);
                                            let datosCargar = data;
                                            
                                            let found = false;

                                           /*  for (var id in datosCargar.id) {
                                                if (id === "1") {
                                                    found = true;
                                                    break;
                                                }
                                            } */
                                            console.log(datosCargar[0]);
                                                $("#txt_descripcion").val(datosCargar.nombre);
                                                $("#th_id_articulo").html(datosCargar.id);
                                                $("#th_precio").html(datosCargar.precio);
                                                $("#txt_Stock").val(datosCargar.stock);
                                                $("#txt_precioTotal").html(datosCargar.precio);
                                                precioArticulo = parseInt(datosCargar.precio);

                                                id_articuloAgregar = datosCargar.id;
                                                nombre_articuloAgregar = datosCargar.nombre;
                                            if (found || $('#txt_descripcion').val() == '' ) {
                                                vaciarCampos();
                                               
                                            } else {
                                                
                                            }




                                        }
                                    },
                                    error: function (error) {

                                    }
                                });
                            } else {
                                vaciarCampos();
                            }


                        });




                    }
                },
                error: function (error) {

                }
            });
        }


    });
    //Termina---Buscar articulo por nombre en FACTURACIÓN

    //Habilitar BOTON AGREGAR FACTURA
    $("#txt_Cantidad").change(function (e) {
        e.preventDefault();
        parseInt($("#txt_Cantidad").val());
        let precioTotal = parseInt($("#txt_Cantidad").val()) * precioArticulo;
        parseInt($("#txt_precioTotal").val(precioTotal));

        cantidad_articuloAgregar = $("#txt_Cantidad").val();
        precio_articuloAgregar = precioTotal;

        if (parseInt($("#txt_Cantidad").val()) >= 1 && parseInt($("#txt_Cantidad").val()) <= parseInt($("#txt_Stock").val())) {
            $('#btnAgregarFactura').attr('disabled', false);
        } else {
            $('#btnAgregarFactura').attr('disabled', true);
        }

    });


    //Termina---Habilitar BOTON AGREGAR FACTURA

    // Funcionamiento de botón que agrega el articulo a la factura
    let contadorBotonFactura = 1;
    let arrayArticulos = [];
    let arraySubtotal = [];


   /*  $("#btnAgregarFactura").click(function (e) {
        //let idArticulo = $('#th_id_articulo').val();
        let descripcion = $('#txt_descripcion').val();
        let cantidad = $('#txt_Cantidad').val();
        //let precioTotal = $('#th_precioTotal').val();

       
        textoInsertado = `
                <tr>
                <th scope="col-1" class="align-middle text-center" id="${contadorBotonFactura}idArticulo_detalle">
                ${id_articuloAgregar} 
                </th>
                <th scope="col-1" class="align-middle text-center" id="${contadorBotonFactura}descripcion_detalle">
                ${nombre_articuloAgregar}
                </th>
                
                <th scope="col-1" class="align-middle text-center" id="${contadorBotonFactura}cantidad_detalle"> 
                ${cantidad_articuloAgregar}
                </th>
                
                <th scope="col-1" class="align-middle text-center" id="${contadorBotonFactura}precioTotal_detalle">
                ${precio_articuloAgregar}
                </th>
                </tr>
                `;
        $('#tbody_detalle').append(textoInsertado);
        articulo = new Object();
        
        articulo.nroRenglon = i;
        articulo.id_articulo = id_articuloAgregar;
        articulo.nombre = nombre_articuloAgregar;
        articulo.cantidad = cantidad_articuloAgregar;
        articulo.precioTotal = precio_articuloAgregar;
        arrayArticulos.push(articulo);
        arraySubtotal.push(precio_articuloAgregar);
       
        i += 1;
        limpiarCamposArt();

        $('#btnAgregarFactura').attr('disabled', true);
        $('#btnProcesarCompra').attr('disabled', false);

        let subTotal = arraySubtotal.reduce((a, b) => a + b, 0);
        $('#txt_subtotalDetalle').val(subTotal);

        
    }); */
    $("#btnAgregarFactura").click(function (e) {
        let descripcion = $('#txt_descripcion').val();
        let cantidad = $('#txt_Cantidad').val();
    
        let idArticuloConcatenado = id_articuloAgregar + "idArticulo_detalle";
    
        // Verificar si el artículo ya existe en la tabla
        let articuloExistente = false;
        let filaExistente;
        $('#tbody_detalle tr').each(function () {
            let idArticulo = $(this).find('th').eq(0).attr('id');
            if (idArticulo === idArticuloConcatenado) {
                articuloExistente = true;
                filaExistente = $(this);
                return false; // Salir del bucle each
            }
        });
    
        if (articuloExistente) {
            // Si el artículo ya existe, reemplazar sus valores en la tabla
            filaExistente.find('th').eq(1).text(nombre_articuloAgregar);
            filaExistente.find('th').eq(2).text(cantidad_articuloAgregar);
            filaExistente.find('th').eq(3).text(precio_articuloAgregar);
        } else {
            // Si el artículo no existe, agregarlo a la tabla
            textoInsertado = `
                <tr>
                <th scope="col-1" class="align-middle text-center" id="${idArticuloConcatenado}">
                ${id_articuloAgregar} 
                </th>
                <th scope="col-1" class="align-middle text-center">
                ${nombre_articuloAgregar}
                </th>
                
                <th scope="col-1" class="align-middle text-center"> 
                ${cantidad_articuloAgregar}
                </th>
                
                <th scope="col-1" class="align-middle text-center">
                ${precio_articuloAgregar}
                </th>
                </tr>
            `;
            $('#tbody_detalle').append(textoInsertado);
        articulo = new Object();
        
        articulo.nroRenglon = i;
        articulo.id_articulo = id_articuloAgregar;
        articulo.nombre = nombre_articuloAgregar;
        articulo.cantidad = cantidad_articuloAgregar;
        articulo.precioTotal = precio_articuloAgregar;
        arrayArticulos.push(articulo);
        arraySubtotal.push(precio_articuloAgregar);
        }
    
        // Resto del código...
    
        // Habilitar el botón de procesar compra
        $('#btnProcesarCompra').attr('disabled', false);
    
        // Calcular subtotal y actualizar el campo correspondiente
        let subTotal = 0;
        $('#tbody_detalle tr').each(function () {
            let precioTotal = parseInt($(this).find('th').eq(3).text());
            subTotal += precioTotal;
        });
        $('#txt_subtotalDetalle').val(subTotal);
        limpiarCamposArt();
    });
    
    
    
    //Termina---Funcionamiento de botón que agrega el articulo a la factura

    //Boton que procesa la factura
    /* $("#btnProcesarCompra").click(function (e) {
        let action = 'procesarVenta';
        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, procesarVenta: arrayArticulos },

            success: function (response) {
                if (response == 0) {
                    alert('Húbo un error al enviar articulos ');
                }

                let data = $.parseJSON(response);
               
                if (data) {
                    alert(data);
                    //window.location.href = "./principal.php";
                } else {
                    alert(data);
                }
            },
            error: function (error) {
            }
        });
    }); */
    $("#btnProcesarCompra").click(function (e) {
        let action = 'procesarVenta';
    
        // Actualizar el array de artículos
        let arrayArticulos = [];
        $('#tbody_detalle tr').each(function () {
            let articulo = {
                nroRenglon: $(this).index(),
                id_articulo: $(this).find('th').eq(0).text().trim().replace(/\n/g, ""),
                nombre: $(this).find('th').eq(1).text().trim().replace(/\n/g, ""),
                cantidad: $(this).find('th').eq(2).text().trim().replace(/\n/g, ""),
                precioTotal: $(this).find('th').eq(3).text().trim().replace(/\n/g, "")
            };
            arrayArticulos.push(articulo);
            console.log(arrayArticulos);
        });
    
        // Realizar la llamada AJAX
        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, procesarVenta: arrayArticulos },
    
            success: function (response) {
                if (response == 0) {
                    alert('Hubo un error al enviar los artículos.');
                }
    
                let data = $.parseJSON(response);
    
                if (data) {
                    alert(data);
                    //window.location.href = "./principal.php";
                } else {
                    alert(data);
                }
            },
            error: function (error) {
            }
        });
    });
    
    
    //Termina---Boton que procesa la factura

    

     //Buscador Ecommerce 
     $("#txt_search").keyup(function (e) {
        e.preventDefault();
        let action = 'buscar_ecommerce';
        let buscar = $("#txt_search").val();
        if (buscar.length >= 0) {
            $.ajax({
                url: './../assets/js/ajax.php',
                type: "POST",
                async: true,
                data: { action: action, buscar_ecommerce: buscar },

                success: function (response) {
                    if (response == 0) {
                        
                    } else {
                        let resultado = response;
                        $('.ProductsList').html(resultado);
                        $(".Menu_Search-Input").val($("#txt_search").val());
                    }

                },
                error: function (error) {
                }
            });
        } else {

        }

    });
    //Con el buscador de Menu
    $(".Menu_Search-Input").keyup(function (e) {
        e.preventDefault();
        let action = 'buscar_ecommerce';
        let buscar = $(".Menu_Search-Input").val();
        if (buscar.length >= 0) {
            $.ajax({
                url: './../assets/js/ajax.php',
                type: "POST",
                async: true,
                data: { action: action, buscar_ecommerce: buscar },

                success: function (response) {
                    if (response == 0) {
                        
                    } else {
                        let resultado = response;
                        $('.ProductsList').html(resultado);
                        $("#txt_search").val($(".Menu_Search-Input").val());
                    }

                },
                error: function (error) {
                }
            });
        } else {

        }

    });

    //Termina --- Buscador Ecommerce
     //Buscador Ecommerce 
     $("#txt_search_listaArticulos").keyup(function (e) {
        e.preventDefault();
        let action = 'buscar_listaArticulos';
        let buscar = $("#txt_search_listaArticulos").val();
        if (buscar.length >= 0) {
            $.ajax({
                url: './../assets/js/ajax.php',
                type: "POST",
                async: true,
                data: { action: action, buscar_listaArticulos: buscar },

                success: function (response) {
                    if (response == 0) {
                        
                    } else {
                        
                        let resultado = response;
                        $('#recibe_listaArticulos').html(resultado);
                    }

                },
                error: function (error) {
                }
            });
        } else {

        }

    });

    //Termina --- Buscador Ecommerce

    //Comienza --- Visor de imagenes en articulo seleccionado

    const MainImage = document.querySelector(".MainProduct__Img");//Main Image

    const SecondaryImage = document.querySelectorAll(".ProductCarrousel__Img");//Secondary Images

    SecondaryImage.forEach((img) => {
        img.addEventListener("click", () => {
            MainImage.src = img.src;
        });
    });//Image Changer Function

    //Termina --- Visor de imagenes en articulo seleccionado


    //Verificacion de existencia de ID articulo 
    $("#txt__codArticulo").keyup(function (e) {
        e.preventDefault();
        let action = 'buscar_idArticulo';
        let buscar = $("#txt__codArticulo").val();
        if ($("#txt__codArticulo").val() == '') {
            $('#txt__codArticulo').removeClass('border border-success');
            $('#txt__codArticulo').removeClass('border border-danger');
        }

        if (buscar.length >= 1) {
            $.ajax({
                url: './../assets/js/ajax.php',
                type: "POST",
                async: true,
                data: { action: action, buscar_idArticulo: buscar },

                success: function (response) {
                    let data = $.parseJSON(response);
                    
                    if (data == 'Existe') {
                        verificacion_codigoArt = 'si';
                        $('#txt__codArticulo').removeAttr("class");
                        $('#txt__codArticulo').addClass('form-control border border-danger');
                        

                    } else {
                        verificacion_codigoArt = 'no';
                        $('#txt__codArticulo').removeAttr("class");
                        $('#txt__codArticulo').addClass('form-control border border-success');
                        
                        
                    }

                },
                error: function (error) {
                }
            });
        } else {

        }

    });

    //Termina --- Verificacion de existencia de ID articulo

    //Verificacion de existencia de NOMBRE articulo 
    $("#txt__nombreArticulo").keyup(function (e) {
        e.preventDefault();
        let action = 'buscar_nombreArticulo';
        let buscar = $("#txt__nombreArticulo").val();

        if ($("#txt__nombreArticulo").val() == '') {
            $('#txt__nombreArticulo').removeClass('border border-success');
            $('#txt__nombreArticulo').removeClass('border border-danger');
        }
        if (buscar.length >= 1) {
            $.ajax({
                url: './../assets/js/ajax.php',
                type: "POST",
                async: true,
                data: { action: action, buscar_nombreArticulo: buscar },

                success: function (response) {
                    let data = $.parseJSON(response);
                    
                    if (data == 'Existe') {
                        verificacion_nombreArt = 'si';
                        $('#txt__nombreArticulo').removeAttr("class");
                        $('#txt__nombreArticulo').addClass('form-control border border-danger');
                        

                    } else if (data == 'noExiste') {
                        verificacion_nombreArt = 'no';
                        $('#txt__nombreArticulo').removeAttr("class");
                        $('#txt__nombreArticulo').addClass('form-control border border-success');
                        
                    }

                },
                error: function (error) {
                }
            });
        } else {

        }

    });

    //Termina --- Verificacion de existencia de NOMBRE articulo

    //Comienza --- Establece fecha actual al final del balance

    // Obtener los elementos de fecha de inicio y fecha final
    

    // Configurar el datepicker de fecha de inicio
    fechaInicio.datepicker({
        dateFormat: "yy-mm-dd",
        showButtonPanel: false,
        onSelect: function (selectedDate) {
            // Establecer la fecha máxima permitida en el datepicker de fecha final
            fechaFinal.datepicker("option", "minDate", selectedDate);
        }
    });


    //Comenzar --- Fecha incio del mes

    let primerDiaDelMes = obtenerPrimerDiaDelMes();
    //Termina --- Fecha incio del mes

    // Configurar el datepicker de fecha final
    let fechaActual = new Date();

    let year = fechaActual.getFullYear();
    let month = ('0' + (fechaActual.getMonth() + 1)).slice(-2);
    let day = ('0' + fechaActual.getDate()).slice(-2);

    var ultimoDiaMes = new Date(fechaActual.getFullYear(), fechaActual.getMonth() + 1, 0);

    // Guardar la fecha del último día del mes en una variable
    var fechaUltimoDiaMes = ultimoDiaMes.toISOString().split('T')[0];

    // Configurar el datepicker para seleccionar el último día del mes
    $("#miDatepicker").datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: new Date(fechaActual.getFullYear(), fechaActual.getMonth(), ultimoDiaMes)
    });

    let fechaFormateada = year + '-' + month + '-' + day;
    $("#date_Final-balance").val(fechaUltimoDiaMes);
    $("#date_Inicio-balance").val(primerDiaDelMes);
    fechaFinal.datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (selectedDate) {
            // Establecer la fecha mínima permitida en el datepicker de fecha de inicio
            fechaInicio.datepicker("option", "maxDate", selectedDate);
        }
    });


    //Termina --- Establece fecha actual al final del balance

    //Comienza --- Calcular balance

    $("#btn_Calcular-balance").click(function (e) {
        e.preventDefault();
        let arrayFechas = [];
        let inicio = $("#date_Inicio-balance").val();
        let final = $("#date_Final-balance").val();
        arrayFechas.push(inicio, final);
       

        let action = 'calcularBalance';
        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, calcularBalance: arrayFechas },

            success: function (response) {
                let data = $.parseJSON(response);
                if (data['total_gastos']==null) {
                    data['total_gastos'] = 0;
                }
                if (data['total_ventas']== null) {
                    data['total_ventas'] = 0;
                }
                let resultadoFinal = data['total_ventas'] - data['total_gastos']
                let resultadoFixed = resultadoFinal.toFixed(2);
               
                if (resultadoFinal == 0 || resultadoFinal == 0.00 ) {
                    $("#recibeBalance").html("$" + 0);
                    $("#recibeBalance").html("$" + resultadoFixed);
                    $("#recibeBalance").css("color", "black");
                } else {
                    if (resultadoFinal < 0) {
                        $("#recibeBalance").html("$" + resultadoFixed);
                        $("#recibeBalance").css("color", "red");
                    } else {
                        $("#recibeBalance").html("$" + resultadoFixed);
                        $("#recibeBalance").css("color", "green");
                    }

                }

                

            },
            error: function (error) {
            }
        });
        mostrarLista_gastosFechas_parametros(fechaInicio.val(),fechaFinal.val());
        mostrarLista_ventasFechas_parametros(fechaInicio.val(),fechaFinal.val());
        
    });

    //Termina --- Calcular balance

    //Comienza --- Selector de búsqueda en gastos

    $("#dropdown_busquedaGastos").on("click", ".dropdown-item", function () {
        let formularioSeleccionado = $(this).data("opcion");
        let html;
        // Cargar el formulario correspondiente utilizando .load()



        if (formularioSeleccionado == 'Concepto') {
            $('#buscadorConcepto').removeClass('d-none');
            $('#buscadorProveedor').addClass('d-none');
            $('#txt_searchConcepto').val('');
            $('#buscadorFechas').addClass('d-none');

                
        } else if (formularioSeleccionado == 'Proveedor') {
            $('#buscadorProveedor').removeClass('d-none');
            $('#buscadorConcepto').addClass('d-none');
            $('#txt_searchProveedor').val('');
            $('#buscadorFechas').addClass('d-none');

          
        } else if (formularioSeleccionado == 'Entre fechas') {
            $('#buscadorFechas').removeClass('d-none');
            $('#buscadorConcepto').addClass('d-none');
            $('#buscadorProveedor').addClass('d-none');
            // Inicializar los datepickers
           

            let fechaInicio = $("#date_Inicio-Gastos");
            let fechaFin = $("#date_Final-Gastos");

            // Configurar el datepicker de fecha de inicio
            fechaInicio.datepicker({
                dateFormat: "yy-mm-dd",
                showButtonPanel: false,
                onSelect: function (selectedDate) {
                    // Establecer la fecha máxima permitida en el datepicker de fecha final
                    fechaFinal.datepicker("option", "minDate", selectedDate);
                }
            });


            //Comenzar --- Fecha incio del mes

            let primerDiaDelMes = obtenerPrimerDiaDelMes();
            //Termina --- Fecha incio del mes

            // Configurar el datepicker de fecha final
            let fechaActual = new Date();

            let year = fechaActual.getFullYear();
            let month = ('0' + (fechaActual.getMonth() + 1)).slice(-2);
            let day = ('0' + fechaActual.getDate()).slice(-2);

            var ultimoDiaMes = new Date(fechaActual.getFullYear(), fechaActual.getMonth() + 1, 0);

            // Guardar la fecha del último día del mes en una variable
            var fechaUltimoDiaMes = ultimoDiaMes.toISOString().split('T')[0];

            // Configurar el datepicker para seleccionar el último día del mes
            $("#miDatepicker").datepicker({
                dateFormat: "yy-mm-dd",
                maxDate: new Date(fechaActual.getFullYear(), fechaActual.getMonth(), ultimoDiaMes)
            });

            let fechaFormateada = year + '-' + month + '-' + day;
            $("#date_Final-Gastos").val(fechaUltimoDiaMes);
            $("#date_Inicio-Gastos").val(primerDiaDelMes);
            fechaFinal.datepicker({
                dateFormat: "yy-mm-dd",
                onSelect: function (selectedDate) {
                    // Establecer la fecha mínima permitida en el datepicker de fecha de inicio
                    fechaInicio.datepicker("option", "maxDate", selectedDate);
                }
            });
            //Comienza --- Buscador entre fechas para lista de gastos

            

            $("#buscar_Fecha-Gastos").click(function (e) {
                e.preventDefault();
                mostrarLista_gastosFechas();
                fechaInicio.val();
                fechaFinal.val();


            });
            $("#date_Inicio-Gastos").datepicker({
                dateFormat: "yy-mm-dd",
                maxDate: new Date(fechaActual.getFullYear(), fechaActual.getMonth(), ultimoDiaMes)
            });
            $("#date_Final-Gastos").datepicker({
                dateFormat: "yy-mm-dd",
                maxDate: new Date(fechaActual.getFullYear(), fechaActual.getMonth(), ultimoDiaMes)
            });

            //Termina --- Buscador entre fechas para lista de gastos
        }


    });

    //Termina --- Selector de búsqueda en gastos

    //Buscador por concepto en Lista__Gastos 
    
    $("#txt_searchConcepto").keyup(function (e) {
        e.preventDefault();
        buscar_conceptoLista__Gastos($("#txt_searchConcepto").val());
    });

    //Termina --- Buscador por concepto en Lista__Gastos

    //Buscador por proveedor en Lista__Gastos 
    
    $("#txt_searchProveedor").keyup(function (e) {
        e.preventDefault();
        buscar_proveedorLista__Gastos($("#txt_searchProveedor").val());
    });

    //Termina --- Buscador por concepto en Lista__Gastos

    
//ABRIR MODAL FORMULARIO INSERTAR STOCK POR ID

$("[id^='insertarStock']").click(function (e) {
    e.preventDefault();
    art_id = $(this).attr('data-art_id');

    

    let action = 'insertarStock';

    $.ajax({
        url: './../assets/js/ajax.php',
        type: "POST",
        async: true,
        data: { action: action, insertarStock: art_id },


        success: function (response) {


            if (response == 0) {
                
            }
            let data = $.parseJSON(response);
            
            let innerHTML = `
            <form>
            <div class="col text-center">
            <label for="" class="">ID del Artículo:<span id='modal-insertarStock_ID'>${data.art_id}</span></label>
            </div>
          <div class="row mb-3 text-center">
            <div class="col">
              <label for="inputArticulo" class="form-label">Nombre de articulo: </label>
              <input type="text" class="form-control" id="modal-insertarStock_nombre" disabled value='${data.art_nom}'>
            </div>
            <div class="col">
              <label for="inputStock" class="form-label">Stock:</label>
              <input type="number" class="form-control" id="modal-insertarStock_cantidad" placeholder="Ingrese cantidad" required>
            </div>
          </div>
          <hr>
          <div class="mb-3">
          <label for="MatsArt">Concepto:</label>
          <input type="text" name="Concepto" id="modal-insertarStock_concepto" class="form-control" required>
          <div class="AddProduct_FormContainer-Row">
          <!--Concepto Articulo-->
              <div class="AddProduct_InputContainer">
                    <label for="MatsArt">Proveedor:</label>
                    <input type="text" name="proveedor" id="modal-insertarStock_proveedor" class="form-control" required>
                 
              </div>
              <div class="AddProduct_InputContainer">
                  <!--Gasto Total-->
                  <label for="MatsArt">Gasto Total:</label>
                  <input type="number" name="gastoTotal" id="modal-insertarStock_gasto" class="form-control" required>
              </div>
          </div>
          </div>
        </form>`;
            $('#recibe_data-insertarStock').html(innerHTML);
        },
        error: function (error) {
            alert(error);
        }
    });

});
//Termina -ABRIR MODAL FORMULARIO INSERTAR STOCK POR ID
//Boton que ELIMINA ARTICULO EN MODAL
$("#modal-insertarStock-btn").click(function (e) {
    e.preventDefault();
    if ($("#modal-insertarStock_cantidad").val().trim() !== "" && $("#modal-insertarStock_concepto").val().trim() !== ""  && $("#modal-insertarStock_proveedor").val().trim() !== ""  && $("#modal-insertarStock_gasto").val().trim() !== ""  ) {
        art_id = $("#modal-insertarStock_ID").html();
        let cantidad = $("#modal-insertarStock_cantidad").val();
        let concepto = $("#modal-insertarStock_concepto").val();
        let proveedor= $("#modal-insertarStock_proveedor").val();
        let gasto = $("#modal-insertarStock_gasto").val();
        let action = 'insertar_cantidadStock';
        let arrayInsertarStock = [];
        arrayInsertarStock.push(art_id, cantidad ,concepto,proveedor,gasto);
        
        $.ajax({
            url: './../assets/js/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, insertar_cantidadStock: arrayInsertarStock},
            success: function (response) {
                data = $.parseJSON(response);
                if (data == 'exito') {
                    location.reload();
                } else {
                    alert('Húbo un error al Insertar stock');
                }
            },
            error: function (error) {
            }
        });
    }else{
        alert('Debe completar todos los campos');
    }
});

//Termina---Boton que ELIMINA ARTICULO EN MODAL

//

$("#select__categoria").on('change',function (e) {
    var selectedValue = $(this).val();
    console.log(selectedValue + 'hubo un cambio');
});

//

/*--Funcion de Menu--*/
if (document.querySelector(".Nav_Menu-Open")) {
    const MenuButton = document.querySelector(".Nav_Menu-Open");

    const Menu = document.querySelector(".Menu");

    MenuButton.addEventListener("click", () => {
        if (Menu.classList.contains("MenuActive")) {
        Menu.classList.remove("MenuActive");
        } else {
        Menu.classList.add("MenuActive");
        }
    });
}

/*---------------------------------*/


});


