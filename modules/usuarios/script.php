<script>
    $(document).ready(function() {

        // --------------------------------------------------------------------------------------------------------------
        // VARIABLES GLOBALES Y CARGA INICIAL
        // -------------------------------------------------------------------------------------------------------------- 
        var identificador_login = "<?php echo Session::get('identificador') ?>";
        var datatable = null;

        // DESABILITO EL IDENTIFICADOR
        $("#identificador").prop("readonly", false)

        cargar();

        // --------------------------------------------------------------------------------------------------------------
        // CARGAR
        // -------------------------------------------------------------------------------------------------------------- 
        function cargar() {

            // ESTABLEZCO EL VALOR DE TABLA DONDE VOY A METER EL DATATABLE (ID DE LA TABLA EN EL DOM)
            let tabla = "#tabla_datos";

            // RESETEO DE LA TABLA
            if ($.fn.dataTable.isDataTable(tabla)) {
                $(tabla).dataTable().fnDestroy();
                $(tabla).html("");
                let datatable = "";
            }

            $.ajax({
                data: {},
                url: '<?php echo CURRENT_MODULE ?>cargar',
                type: 'POST',
                beforeSend: function() {
                    $('.loader_ajax').show()
                },
                success: function(data) {

                    data = JSON.parse(data);

                    if (data === 'error_sql') {
                        alert("Ha ocurrido un error, contacta con el responsable.")
                    } else if (data === 'sin_datos') {
                        alert("No hay datos almacenados.")
                    } else {

                        // CARGO EL DATATABLE
                        datatable = $(tabla).DataTable({
                            language: {
                                decimal: "",
                                emptyTable: "No hay información",
                                info: "Mostrando _END_ de _TOTAL_ entradas",
                                infoEmpty: "Mostrando 0 de 0 entradas",
                                infoFiltered: "(Filtrado de _MAX_ entradas en total)",
                                infoPostFix: "",
                                thousands: ",",
                                lengthMenu: "Mostrar _MENU_ entradas",
                                loadingRecords: "Cargando...",
                                processing: "Procesando...",
                                search: "Buscar:",
                                zeroRecords: "Sin resultados encontrados",
                                paginate: {
                                    first: "Primero",
                                    last: "Ultimo",
                                    next: "Siguiente",
                                    previous: "Anterior",
                                },
                            },
                            data: data.datatable_data,
                            columns: data.datatable_columns,
                            columnDefs: data.datatable_columns_def,
                            orderCellsTop: true,
                            select: false,
                            dom: "Blftrip",
                            pageLength: 10,
                            order: [],
                            buttons: [],
                            scrollX: false,
                            rowCallback: function(row, data) {}
                        });

                    }
                    $('.loader_ajax').hide();
                },

            });
        }

        // --------------------------------------------------------------------------------------------------------------
        // GUARDAR
        // -------------------------------------------------------------------------------------------------------------- 
        $('#btn_guardar').off('click').on('click', function() {

            var inputs = $(".input_guardar");
            var valores = {};
            var validador = true;

            // RECORRE TODOS LOS ELEMENTOS CON LA CLASE "input_guardar"
            inputs.each(function(index) {

                // OBTENGO LOS ATRIBUTOS
                var id = $(this).attr("id");
                var valor = $(this).val().trim();

                // VALIDO LOS ELEMENTOS VACIOS
                if (valor === "") {
                    mensaje = "Por favor, complete todos los campos.";
                    validador = false;
                }

                // ALMACENO LOS DATOS EN UN ARRAY INDEXADO POR EL ID
                valores[id] = valor;

            });

            // VALIDO SI LAS CONTRASEÑAS SON IGUALES
            var password = $('#pass').val();
            var confirmPassword = $('#confirmar_pass').val();

            if (password !== confirmPassword) {
                validador = false
            }

            // HAGO LA PETICION SI ESTA LLENA
            if (validador == false) {
                alert('Todos los campos deben estar rellenos y las contraseñas sean iguales.');
            } else {

                if (confirm("¿Estás seguro de que deseas guardar los datos?")) {

                    $.ajax({
                        data: {
                            'identificador_login': identificador_login,
                            'valores': valores
                        },
                        url: '<?php echo CURRENT_MODULE ?>guardar',
                        type: 'POST',
                        beforeSend: function() {
                            $('.loader_ajax').show()
                        },
                        success: function(data) {

                            data = JSON.parse(data);
                            // console.log(data);

                            if (data === 'error_sql') {
                                alert("Ha ocurrido un error, contacta con el responsable.")
                            } else if (data === 'existe') {
                                alert("El registro ya existe.")
                            } else if (data === 'insert_ok') {

                                alert("Registro guardado.")

                                // ACTUALIZO EL DATATABLE
                                resetear()
                                cargar()

                            }

                            $('.loader_ajax').hide()


                        }
                    });
                }
            }

        });

        // --------------------------------------------------------------------------------------------------------------
        // VER
        // -------------------------------------------------------------------------------------------------------------- 
        $(document).off('click').on('click', '#tabla_datos tbody tr', function() {

            // DESABILITO EL IDENTIFICADOR
            $("#identificador").prop("readonly", true)

            // OBTENER LOS DATOS DE LA FILA CLICADA
            var datos = datatable.row(this).data();

            // OBTENGO EL ID
            var identificador = datos["IDENTIFICADOR"]

            // OBTENGO EL RESTO DE DATOS
            $.ajax({
                data: {
                    'identificador': identificador
                },
                url: '<?php echo CURRENT_MODULE ?>ver_detalle',
                type: 'POST',
                beforeSend: function() {
                    $('.loader_ajax').show()
                },
                success: function(data) {

                    data = JSON.parse(data);

                    if (data === 'error_sql') {
                        alert("Ha ocurrido un error, contacta con el responsable.")
                    } else if (data === 'sin_datos') {
                        alert("No hay datos que recuperar.")
                    } else {

                        for (var i in data) {
                            var element = $('#' + i.toLowerCase());
                            if (element.length) {
                                element.val(data[i]);
                            }
                        }

                        // OCULTO GUARDAR
                        $("#btn_guardar").addClass("d-none")

                        // MUESTRO ACTUALIZAR Y ELIMINAR
                        $("#btn_modificar").removeClass("d-none");
                        $("#btn_eliminar").removeClass("d-none");

                    }

                    $('.loader_ajax').hide()


                }
            });

        });

        // --------------------------------------------------------------------------------------------------------------
        // ACTUALIZAR
        // -------------------------------------------------------------------------------------------------------------- 
        $('#btn_modificar').off('click').on('click', function() {

            var inputs = $(".input_guardar");
            var valores = {};
            var validador = true;

            // RECORRE TODOS LOS ELEMENTOS CON LA CLASE "input_guardar"
            inputs.each(function(index) {

                // OBTENGO LOS ATRIBUTOS
                var id = $(this).attr("id");
                var valor = $(this).val().trim();

                // VALIDO LOS ELEMENTOS VACIOS
                if (valor === "" && id !== "pass") {
                    mensaje = "Por favor, complete todos los campos.";
                    validador = false;
                    return false;
                }

                // ALMACENO LOS DATOS EN UN ARRAY INDEXADO POR EL ID
                valores[id] = valor;

            });

            // HAGO LA PETICION SI ESTA LLENA
            if (validador == false) {
                alert('Todos los campos deben estar rellenos.');
            } else {

                if (confirm("¿Estás seguro de que deseas guardar los cambios?")) {

                    $.ajax({
                        data: {
                            'identificador_login': identificador_login,
                            'valores': valores
                        },
                        url: '<?php echo CURRENT_MODULE ?>modificar',
                        type: 'POST',
                        beforeSend: function() {
                            $('.loader_ajax').show()
                        },
                        success: function(data) {

                            data = JSON.parse(data);
                            // console.log(data);

                            if (data === 'error_sql') {
                                alert("Ha ocurrido un error, contacta con el responsable.")
                            } else if (data === 'existe') {
                                alert("El registro ya existe.")
                            } else {

                                alert("Registro modificado.")

                                // ACTUALIZO EL DATATABLE
                                resetear()
                                cargar()

                            }

                            $('.loader_ajax').hide()

                        }
                    });
                }
            }

        });

        // --------------------------------------------------------------------------------------------------------------
        // ELIMINAR
        // -------------------------------------------------------------------------------------------------------------- 
        $('#btn_eliminar').off('click').on('click', function() {

            var identificador = $('#identificador').val()

            if (identificador == "") {
                alert("Vuelve a cargar, no hemos podido obtener el identificador")
            } else {

                if (confirm("¿Estás seguro de que deseas guardar los cambios?")) {

                    $.ajax({
                        data: {
                            'identificador': identificador
                        },
                        url: '<?php echo CURRENT_MODULE ?>eliminar',
                        type: 'POST',
                        beforeSend: function() {
                            $('.loader_ajax').show()
                        },
                        success: function(data) {

                            data = JSON.parse(data);
                            // console.log(data);

                            if (data === 'error_sql') {
                                alert("Ha ocurrido un error, contacta con el responsable.")
                            } else {

                                alert("Registro eliminado.")

                                // ACTUALIZO EL DATATABLE
                                resetear()
                                cargar()
                            }

                            $('.loader_ajax').hide()

                        }
                    });
                }
            }

        });

        // --------------------------------------------------------------------------------------------------------------
        // RESETEAR
        // -------------------------------------------------------------------------------------------------------------- 

        // FUNCION
        function resetear() {

            // RECORRE TODOS LOS ELEMENTOS CON LA CLASE "input_guardar"
            var inputs = $(".input_guardar");
            inputs.each(function(index) {

                // VACIO LOS CAMPOS
                $(this).val("");

            });

            // HABILITO EL IDENTIFICADOR
            $("#identificador").prop("readonly", false)

            // OCULTO GUARDAR
            $("#btn_guardar").removeClass("d-none")

            // MUESTRO ACTUALIZAR Y ELIMINAR
            $("#btn_modificar").addClass("d-none");
            $("#btn_eliminar").addClass("d-none");
        }

        // METODO
        $('#btn_resetear').off('click').on('click', function() {
            resetear()
        });

    });
</script>