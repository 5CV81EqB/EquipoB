$(document).ready(function () {
    $("#ediminarA").prop("hidden", true);
    $(".formularioC").prop("hidden", true);
    $(".formularioA").prop("hidden", true);
    $("#editaroeliminarA").prop("hidden", true);
    $("#editaroeliminarC").prop("hidden", true);
    $(".selectautomovil").prop("hidden", true);
    $("#tablaA").prop("hidden", true);
    $("#tablaC").prop("hidden", true);

    var validador = $("#ClientesForm").validate({
        rules: {
            nombre: {
                required: true,
                lettersonly: true
            },
            app: {
                required: true,
                lettersonly: true
            },
            apm: {
                required: true,
                lettersonly: true
            },
            fecnac: {
                required: true
            },
            correo: {
                required: true
            },
            calle: {
                required: true
            },
            cp: {
                required: true
            },
            munic: {
                required: true
            },
            estado: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Por favor llena el campo",

            },
            app: {
                required: "Por favor llena el campo",

            },
            apm: {
                required: "Por favor llena el campo",
            },
            fecnac: "llena el campo",
            correo: "llena el campo",
            calle: "llena el campo",
            cp: "llena el campo",
            munic: "llena el campo",
            estado: "llena el campo",

        },
    });


    $.ajax({
        url: './clases/cliente.php', // Ruta al archivo PHP
        method: 'GET', // Método de solicitud (POST o GET)
        data: {
            funcion: 'select', // Nombre de la función que deseas llamar en el archivo PHP
        },
        success: function (response) {
            // Configuración de la tabla jqxGrid
            var source = {
                datatype: 'json',
                datafields: [
                    // Define los campos de los datos recibidos
                    { name: 'id', type: 'int' },
                    { name: 'Nombre', type: 'string' },
                    { name: 'Apellido_p', type: 'string' },
                    { name: 'Apellido_M', type: 'string' },
                    { name: 'Fecha_de_nacimiento', type: 'string' },
                    { name: 'correo', type: 'string' },
                    { name: 'calle', type: 'string' },
                    { name: 'cp', type: 'string' },
                    { name: 'municipio', type: 'string' },
                    { name: 'estado', type: 'string' },
                ],
                localdata: response // Asigna los datos recibidos a localdata
            };
            var dataAdapter = new $.jqx.dataAdapter(source);

            // Crea la tabla jqxGrid en el contenedor deseado
            jQuery().ready(function () {

                $('#tablaC').jqxGrid({
                    source: dataAdapter,
                    sortable: false,
                    filterable: false,
                    columnsresize: false,
                    pageable: false,
                    width: '95%',
                    autoheight: true,
                    autoshowfiltericon: false,
                    source: dataAdapter,
                    columns: [
                        // Define las columnas de la tabla
                        { text: 'ID', datafield: 'id', width: '3%' },
                        { text: 'nombre', datafield: 'Nombre', width: '10%' },
                        { text: 'Apellido Paterno', datafield: 'Apellido_p', width: '10%' },
                        { text: 'Apellido Materno', datafield: 'Apellido_M', width: '10%' },
                        { text: 'Fecha de nacimiento', datafield: 'Fecha_de_nacimiento', width: '20%' },
                        { text: 'Correo electronico', datafield: 'correo', width: '12%' },
                        { text: 'Calle', datafield: 'calle', width: '10%' },
                        { text: 'Codigo Postal', datafield: 'cp', width: '10%' },
                        { text: 'Municipio', datafield: 'municipio', width: '10%' },
                        { text: 'Estado', datafield: 'estado', width: '5%' },
                    ]
                });
            });
        },
        error: function (xhr, status, error) {
            // Manejar errores
            console.error(error);
        }
    });



    $("#tablaC").prop("hidden", true);
    $("#opcionadministrar").on("change", function () {
        switch (this.value) {
            case '1': {
                $("#tablaC").prop("hidden", false);
                $("#tablaA").prop("hidden", true);
                $(".selectautomovil").prop("hidden", true);
                $(".formularioA").prop("hidden", true);
                $("#agregarA").prop("hidden", true);
                $("#editaroeliminarA").prop("hidden", true);
                $("#AutosForm").prop("hidden", true);
                $("#ediminarA").prop("hidden", true);
                $("tablaA").prop("hidden", true);
            }
                break;
            case '2': {
                $("#tablaA").prop("hidden", false);
                $("#tablaC").prop("hidden", true);
                $(".selectautomovil").prop("hidden", false);
                $(".formularioC").prop("hidden", true);
                //Obtener opciones para los clientes

                $.ajax({
                    url: './clases/automovil.php',
                    type: 'GET',
                    data: {
                        funcion: 'cliente',
                    },
                    success: function (opciones) {
                        // Obtener el elemento select por su ID
                        var select = $('#clienteautomovil');

                        // Asignar las opciones obtenidas al elemento select
                        select.html(opciones);
                    },
                    error: function (xhr, status, error) {
                        console.log('Error en la solicitud AJAX: ' + error);
                    }
                });

                $("#clienteautomovil").on("change", function () {
                    var iden = this.value;
                    $.ajax({
                        url: './clases/automovil.php',
                        type: 'GET',
                        data: {
                            funcion: 'select',
                            id: iden,

                        },
                        success: function (response) {
                            // Configuración de la tabla jqxGrid
                            var source = {
                                datatype: 'json',
                                datafields: [
                                    // Define los campos de los datos recibidos
                                    { name: 'matricula', type: 'string' },
                                    { name: 'modelo', type: 'string' },
                                    { name: 'anio', type: 'string' },
                                    { name: 'color', type: 'string' },
                                    { name: 'fecha_entrada', type: 'string' },
                                ],
                                localdata: response // Asigna los datos recibidos a localdata
                            };
                            var dataAdapter = new $.jqx.dataAdapter(source);

                            // Crea la tabla jqxGrid en el contenedor deseado
                            jQuery().ready(function () {

                                $('#tablaA').jqxGrid({
                                    source: dataAdapter,
                                    sortable: false,
                                    filterable: false,
                                    columnsresize: false,
                                    pageable: false,
                                    width: '95%',
                                    autoheight: true,
                                    autoshowfiltericon: false,
                                    source: dataAdapter,
                                    columns: [
                                        // Define las columnas de la tabla
                                        { text: 'matricula', datafield: 'matricula', width: '16%' },
                                        { text: 'modelo', datafield: 'modelo', width: '20%' },
                                        { text: 'Año', datafield: 'anio', width: '20%' },
                                        { text: 'Color', datafield: 'color', width: '20%' },
                                        { text: 'Fecha de entrada', datafield: 'fecha_entrada', width: '24%' },
                                    ]
                                });
                            });

                        },
                        error: function (xhr, status, error) {
                            console.log('Error en la solicitud AJAX: ' + error);
                        }
                    });


                });



            }
                break;
        }
    });

    $("#agregar").on("click", function () {
        switch ($("#opcionadministrar").val()) {
            case '1': {
                $(".formularioC").prop("hidden", false);
                $("#ediminar").prop("hidden", true);
                $("#editaroeliminarC").prop("hidden", true);
                $("#agregarC").prop("hidden", false);
                $("#btnCGuardar").prop("hidden", false);

                $("#id_cliente").val("");
                $('#nombre').val("");
                $("#app").val("");
                $('#apm').val("");
                $("#fecnac").val("");
                $('#correo').val("");
                $("#calle").val("");
                $('#cp').val("");
                $("#munic").val("");
                $('#estado').val("");
            }
                break;
            case '2': {
                $(".formularioA").prop("hidden", false);
                $("#agregarC").prop("hidden", false);
                $("#btnAGuardar").prop("hidden", false);
                $("#ediminarc").prop("hidden", true);
                $("#ediminarA").prop("hidden", true);
                $("#agregarA").prop("hidden", false);
                $("#editaroeliminarA").prop("hidden", true);
                $("#matricula").val("");
                $("#matricula").prop("readonly", false);
                $('#modelo').val("");
                $("#anio").val("");
                $('#color').val("");
                $("#fecha_entrada").val("");
            }
                break;
            default: alert("Selecciona una opcion valida");
                break;
        }
    });
    //llenar tablas
    $("#tablaC").on('rowdoubleclick', function (event) {
        // Obtén los datos de la fila clickeada
        var rowData = $("#tablaC").jqxGrid('getrowdata', event.args.rowindex);
        $("#ediminar").prop("hidden", false);
        $(".formularioC").prop("hidden", false);
        $("#editaroeliminarC").prop("hidden", false);
        $("#agregarC").prop("hidden", true);
        $("#btnCGuardar").prop("hidden", true);
        // Llena el formulario con los datos de la fila
        $("#id_cliente").val(rowData.id);
        $('#nombre').val(rowData.Nombre);
        $("#app").val(rowData.Apellido_p);
        $('#apm').val(rowData.Apellido_M);
        $("#fecnac").val(rowData.Fecha_de_nacimiento);
        $('#correo').val(rowData.correo);
        $("#calle").val(rowData.calle);
        $('#cp').val(rowData.cp);
        $("#munic").val(rowData.municipio);
        $('#estado').val(rowData.estado);
    });

    $("#tablaA").on('rowdoubleclick', function (event) {
        // Obtén los datos de la fila clickeada
        var rowData = $("#tablaA").jqxGrid('getrowdata', event.args.rowindex);
        $("#ediminarA").prop("hidden", false);
        $(".formularioA").prop("hidden", false);
        $("#editaroeliminarA").prop("hidden", false);
        $("#agregarA").prop("hidden", true);
        $("#btnAGuardar").prop("hidden", true);
        // Llena el formulario con los datos de la fila
        console.log(rowData);
        $("#matricula").val(rowData.matricula);
        $("#matricula").prop("readOnly", true);
        $('#modelo').val(rowData.modelo);
        $("#anio").val(rowData.anio);
        $('#color').val(rowData.color);
        $("#fecha_entrada").val(rowData.fecha_entrada);
    });


    /*
    Modulo de cliente-agregar, eliminar, editar
    */


    $('#btnCGuardar').click(function () {
        if ($("#ClientesForm").valid()) {
            datos = $("#ClientesForm").serialize();
            $.ajax({
                url: './clases/cliente.php',
                type: 'POST',
                data: {
                    funcion: 'insert',
                    datos,
                },
                success: function (response) {
                    alert("Cliente Agregado exitosamente");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Manejar errores
                    alert(error);
                    location.reload();
                }

            });
        }
    });
    $('#btnAGuardar').click(function () {

        var ident = $('#clienteautomovil').val();

        if ($("#AutosForm").valid() && (ident != null || ident != undefined)) {
            datos = $("#AutosForm").serialize();
            $.ajax({
                url: './clases/automovil.php',
                type: 'POST',
                data: {
                    funcion: 'insert',
                    id: ident,
                    datos,
                },
                success: function (response) {
                    alert("Auto Agregado exitosamente");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Manejar errores
                    alert(error);
                    location.reload();
                }

            });

        } else {
            alert("selecciona un cliente");
        }

    });
    // boton editar auto
    $('#btnAeditar').click(function () {
        var ident = $('#clienteautomovil').val();
        if ($("#AutosForm").valid() && (ident != null || ident != undefined)) {
            datos = $("#AutosForm").serialize();
            $.ajax({
                url: './clases/automovil.php',
                type: 'POST',
                data: {
                    funcion: 'update',
                    id: ident,
                    datos,
                },
                success: function (response) {
                    alert("Automovil editado exitosamente");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Manejar errores
                    alert(error);
                    location.reload();
                }

            });

        }

    });

    $('#btnAeliminar').click(function () {

        var ident = $('#clienteautomovil').val();
        if ($("#AutosForm").valid() && (ident != null || ident != undefined)) {
            datos = $("#AutosForm").serialize();
            $.ajax({
                url: './clases/automovil.php',
                type: 'POST',
                data: {
                    funcion: 'delete',
                    id: ident,
                    datos,
                },
                success: function (response) {
                    alert("Automovil removido exitosamente");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Manejar errores
                    alert(error);
                    location.reload();
                }

            });

        }

    });



    // Actualizar registro
    $('#btnCeditar').click(function () {
        if ($("#ClientesForm").valid()) {
            datos = $("#ClientesForm").serialize();
            $.ajax({
                url: './clases/cliente.php',
                type: 'POST',
                data: {
                    funcion: 'update',
                    datos,
                },
                success: function (response) {
                    alert("Cliente Actualizado exitosamente");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Manejar errores
                    alert(error);
                    location.reload();
                }

            });
        }
    });

    // Eliminar registro
    $('#btnCeliminar').click(function () {
        if ($("#ClientesForm").valid()) {
            datos = $("#ClientesForm").serialize();
            $.ajax({
                url: './clases/cliente.php',
                type: 'POST',
                data: {
                    funcion: 'delete',
                    datos,
                },
                success: function (response) {
                    alert(response);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Manejar errores
                    alert(error);
                    location.reload();
                }

            });
        }
    });
    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Solo letras");
}); //ready