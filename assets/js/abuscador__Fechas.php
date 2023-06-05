<script>
    function generarBusqueda_Fecha() {
        var formularioHTML =
    `  <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form class="search-form">
        <div class="input-group mb-3">
        <label for="FechaInicio" class='form-label'>Inicio:</label>
        <input type="text" class="form-control col-2" name='FechaInicio' id="date_Inicio-Gastos" required>
        </div>
        <div class="input-group mb-3">
        <label for="FechaFinal" class='form-label'>Final:</label>
        <input type="text" class="form-control col-2" name="FechaFinal" id="date_Final-Gastos" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary col-6" id="buscar_Fecha-Gastos">Buscar</button>
        </div>
      </form>
    </div>
  </div>
</div>

  `;


  

        // Agregar el formulario generado al contenedor
        $("#contieneBuscador").html(formularioHTML);

        // Inicializar los datepickers
        $("#date_Inicio-Gastos, #date_Final-Gastos").datepicker({
            // Configuración del datepicker
            // Puedes ajustar las opciones según tus necesidades
            dateFormat: "dd/mm/yy",
            // Otros ajustes y eventos necesarios
        });

        let fechaInicio = $("#date_Inicio-Gastos");
    let fechaFin = $("#date_Final-Gastos");

    // Configurar el datepicker de fecha de inicio
    fechaInicio.datepicker({
        dateFormat: "yy-mm-dd",
        showButtonPanel: false,
        onSelect: function (selectedDate) {
            // Establecer la fecha máxima permitida en el datepicker de fecha final
            fechaFin.datepicker("option", "minDate", selectedDate);
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
    fechaFin.datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (selectedDate) {
            // Establecer la fecha mínima permitida en el datepicker de fecha de inicio
            fechaInicio.datepicker("option", "maxDate", selectedDate);
        }
    });
    }


   
    generarBusqueda_Fecha();
</script>