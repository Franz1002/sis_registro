var tableDocSalida;

document.addEventListener('DOMContentLoaded', function () {

    tableDocSalida = $('#tableDocSalida').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {

            'buttons': {
                'pageLength': {
                    _: "Los primeros %d elementos",
                    '-1': "Tamaño"
                },
            },
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"

        },

        "ajax": {
            "url": " " + base_url + "/DocSalidas/getDocSalidas",
            "dataSrc": ""

        },

        'locale': 'fr',
        'colReorder': true,

        'dom': 'Bfrtip',


        'buttons': [
            'pageLength',
            {

                "extend": "copyHtml5",
                "text": "<i class='fa fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fa fa-file-excel-o'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success"
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fa fa-file-pdf-o'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fa fa-file'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info"
            },

        ],
        "columns": [
            { "data": "id_salida" },
            { "data": "titulo_doc" },
            { "data": "usuario" },
            { "data": "area_id" },
            { "data": "destinatario_salida" },
            { "data": "fecha_salida" },

            {
                "data": "archivo_doc",
                "render": function (data, type, row) {
                    var icono = obtenerIconoArchivo2(data); // Función para obtener el ícono según la extensión del archivo
                    return '<a href="/sis_registro/Assets/archivos_doc/' + data + '" target="_blank">' + icono + '</a>';
                }
            },
            { "data": "options" }

        ],
        "responsive": "true",

        "bDestroy": true,

        "order": [[0, "desc"]]
    });


});


function obtenerIconoArchivo(nombreArchivo) {
    var extension = nombreArchivo.substr(nombreArchivo.lastIndexOf('.') + 1).toLowerCase();
    var icono = '';

    switch (extension) {
        case 'pdf':
            icono = '<i class="fa fa-file-pdf-o text-success fa-3x"></i>'; // Icono de PDF de Font Awesome
            break;
        case 'doc':
        case 'docx':
            icono = '<i class="fa fa-file-word-o text-primary fa-3x"></i>'; // Icono de Word de Font Awesome
            break;
        case 'xls':
        case 'xlsx':
            icono = '<i class="fa fa-file-excel-o text-danger fa-3x"></i>'; // Icono de Excel de Font Awesome
            break;
        // Agrega más casos según las extensiones de archivo que quieras reconocer y mostrar iconos
        default:
            icono = '<i class="fa fa-file-o text-primary fa-3x"></i>'; // Icono genérico de archivo de Font Awesome
            break;
    }

    // Envuelve el icono y el texto en un span y aplica el estilo de alineación vertical
    return '<span style="display: inline-block; vertical-align: middle;">' + icono + ' ' + '</span>';
}
function obtenerIconoArchivo2(nombreArchivo) {
    var extension = nombreArchivo.substr(nombreArchivo.lastIndexOf('.') + 1).toLowerCase();
    var nombreSinExtension = nombreArchivo.substr(0, nombreArchivo.lastIndexOf('.'));
    var nombreRecortado = nombreSinExtension.substring(0, 15);

    var icono = '';

    switch (extension) {
        case 'pdf':
            icono = '<i class="fa fa-file-pdf-o text-success fa-2x"></i>';
            break;
        case 'doc':
        case 'docx':
            icono = '<i class="fa fa-file-word-o text-primary fa-2x"></i>';
            break;
        case 'xls':
        case 'xlsx':
            icono = '<i class="fa fa-file-excel-o text-danger fa-2x"></i>';
            break;
        default:
            icono = '<i class="fa fa-file-o text-primary fa-2x"></i>';
            break;
    }

    var archivoCompleto = nombreSinExtension + '.' + extension;

    return '<span style="display: inline-flex; align-items: center;">' +
        '<a href="/sis_registro/Assets/archivos_doc/' + nombreArchivo + '" target="_blank" title="' + archivoCompleto + '">' +
        icono + '</a>' +
        '<span style="margin-left: 5px;">' + nombreRecortado + '.' + extension + '</span>' +
        '</span>';
}


$("#listArchivo").autocomplete({
    appendTo: "#modalFormSalidas",
    source: function (request, response) {
        $.ajax({
            url: "ajax.php",
            dataType: "json",
            data: {
                term: request.term
            },
            success: function (data) {
                response(data);
            }
        });
    },
    focus: function (event, ui) {
        $("#listArchivo").val(ui.item.label);
        $("#listArchivo").attr("data-id", ui.item.id); // Establecer el data-id con el ID del documento
        $("#tituloDoc").val(ui.item.tituloDocs);
        $("#hojaRuta").val(ui.item.hojaRutas);
        $("#remitenteD").val(ui.item.remitentes);

        // Establecer el enlace al archivo y mostrarlo si existe
        var archivoLink = $("#archivoLink");
        archivoLink.attr("href", "/sis_registro/Assets/archivos_doc/" + ui.item.archi);
        archivoLink.show();

        // Mostrar el nombre del archivo con el icono correspondiente
        var archivoIcon = $("#archivoIcon");
        var iconClass = "fa fa-file"; // Icono predeterminado

        // Asignar el icono según la extensión del archivo
        var extension = ui.item.archi.split('.').pop().toLowerCase();
        if (extension === "pdf") {
            iconClass = "fa fa-file-pdf-o text-success fa-2x";
        } else if (extension === "doc" || extension === "docx") {
            iconClass = "fa fa-file-word-o text-primary fa-2x";
        } else if (extension === "xls" || extension === "xlsx") {
            iconClass = "fa fa-file-excel-o text-danger fa-2x";
        }

        archivoIcon.attr("class", "input-group-text " + iconClass);

        // Mostrar el nombre del archivo
        $("#archivo").val(ui.item.archi + " ");
        $("#archivo").addClass("input-with-icon");

        return false; // Evita que el valor seleccionado se muestre en el campo de autocompletar
    }
});

function openModalSalidas() {

    document.querySelector('#idSalidas').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-dark");
    document.querySelector('#btnText').innerHTML = " Registrar";
    document.querySelector('#titleModal').innerHTML = "Registrar salida de documento";
    document.querySelector("#formSalidas").reset();
    $("#listArchivo").val("");
    $("#listArchivo").attr("data-id", "");
    $("#archivoLink").attr("href", "");
    $("#archivoLink").hide();
    $("#archivoIcon").attr("class", "input-group-text");
    $("#archivo").val("");
    $("#archivo").removeClass("input-with-icon");
    $('#modalFormSalidas').modal('show');
}

function registrarDocSalida(e) {
    e.preventDefault();

    const intIdDocS = document.querySelector('#idSalidas').value;
    const usuarioIdInput = document.getElementById("usuarioId");
    const intDocIdInput = document.getElementById("listArchivo");
    const intDocId = intDocIdInput.getAttribute("data-id"); // Obtener el ID del documento
    const strDestinatario = document.getElementById("txtDestinatario");
    const strFechaS = document.querySelector('#txtFechaHoraS').value;
    const intUsuarioId = usuarioIdInput.value;

    if (intUsuarioId === "" || intDocId === null || intDocId === "" || strDestinatario.value === "" || strFechaS === "") {
        Swal.fire({
            icon: 'error',
            title: 'ATENCIÓN',
            text: 'Todos los campos con rojo son obligatorios!'
        });
    } else {
        const xhttp = new XMLHttpRequest();
        const ajaxUrl = base_url + '/DocSalidas/setDocS';

        const formData = new FormData();
        formData.append('idSalidas', intIdDocS);
        formData.append('listArchivo', intDocId);
        formData.append('usuarioId', parseInt(intUsuarioId));
        formData.append('txtDestinatario', strDestinatario.value);
        formData.append('txtFechaHoraS', strFechaS);

        xhttp.open("POST", ajaxUrl, true)
        xhttp.send(formData);
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>REGISTRADO</u></strong>',
                        html: '<h2>Salida de Documento registrado con éxito</h2>',
                        showConfirmButton: true,
                        timer: 3000
                    });
                    $('#modalFormSalidas').modal("hide");
                    formSalidas.reset();
                    tableDocSalida.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>EDITADO</u></strong>',
                        html: '<h2>Salida de Documento editado con éxito</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalFormSalidas').modal("hide");
                    formSalidas.reset();
                    tableDocSalida.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<strong><u>Error</u></strong>',
                        html: '<h2>La salida del documento ya se registro anteriormente</h2>',
                        showConfirmButton: true,
                        timer: 4000

                    });
                }
            }
        };
    }
}



function btnVerDocSalida(id_salida) {
    const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    const ajaxUrl = base_url + '/DocSalidas/getDocSalida/' + id_salida;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            const objData = JSON.parse(request.responseText);

            if (objData.status) {
                document.querySelector("#verTituloDocumento").innerHTML = objData.data.titulo_doc;
                document.querySelector("#verHojaDeRuta").innerHTML = objData.data.hojaderuta;
                document.querySelector("#verArea").innerHTML = objData.data.nombre_area;
                document.querySelector("#verRemitente").innerHTML = objData.data.remitente_doc;
                document.querySelector("#verFechaRecepcion").innerHTML = objData.data.fecha_recepcion;
                document.querySelector("#verUsuario").innerHTML = objData.data.usuario;
                document.querySelector("#verDestinatario").innerHTML = objData.data.destinatario_salida;
                document.querySelector("#verFechaSalida").innerHTML = objData.data.fecha_salida;

                // Mostrar el nombre del archivo y el ícono correspondiente
                if (objData.data.archivo_doc) {
                    const archivoUrl = base_url + '/Assets/archivos_doc/' + objData.data.archivo_doc;
                    const archivoEnlace = document.createElement("a");
                    archivoEnlace.href = archivoUrl;
                    archivoEnlace.target = "_blank";
                    archivoEnlace.classList.add("archivo-enlace"); // Agrega la clase archivo-enlace
                    // Obtener extensión del archivo
                    const extension = objData.data.archivo_doc.split('.').pop().toLowerCase();

                    // Agregar el ícono según la extensión
                    let icono = "fa fa-file-o text-primary fa-4x"; // Por defecto, ícono de archivo genérico
                    if (extension === "pdf") {
                        icono = "fa fa-file-pdf-o text-success fa-4x";
                    } else if (extension === "doc" || extension === "docx") {
                        icono = "fa fa-file-word-o text-primary fa-4x";
                    } else if (extension === "xls" || extension === "xlsx") {
                        icono = "fa fa-file-excel-o text-danger fa-2x";
                    }
                    archivoEnlace.innerHTML = `<i class="fas ${icono}"></i> ${objData.data.archivo_doc}`;
                    document.querySelector("#verArchivo").innerHTML = ""; // Vaciar contenido actual
                    document.querySelector("#verArchivo").appendChild(archivoEnlace); // Agregar nuevo enlace
                } else {
                    document.querySelector("#verArchivo").innerHTML = "No hay archivo adjunto.";
                }

                $('#modalVerDocSalida').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}


function btnEditarDocSalida(id_salida) {
    document.getElementById("titleModal").innerHTML = "Actualizar datos de la Salida del Documento";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("btnText").innerHTML = " Actualizar";
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = base_url + '/DocSalidas/getDocSalida/' + id_salida;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);

            if (result.status) {

                document.getElementById("idSalidas").value = result.data.id_salida;
                document.getElementById("txtUsuario").value = result.data.usuario;
                document.getElementById("listArchivo").value = result.data.archivo_doc;
                document.getElementById("tituloDoc").value = result.data.titulo_doc;
                document.getElementById("hojaRuta").value = result.data.hojaderuta;
                document.getElementById("remitenteD").value = result.data.remitente_doc;
                document.getElementById("txtDestinatario").value = result.data.destinatario_salida;
                $("#listArchivo").attr("data-id", result.data.doc_id); 


                if (result.data.archivo_doc) {
                    const archivoUrl = base_url + '/Assets/archivos_doc/' + result.data.archivo_doc;
                    const archivoEnlace = document.createElement("a");
                    archivoEnlace.href = archivoUrl;
                    archivoEnlace.target = "_blank";
                    archivoEnlace.classList.add("archivo-enlace"); // Agrega la clase archivo-enlace

                    // Establece el enlace al archivo y mostrarlo
                    var archivoLink = $("#archivoLink");
                    archivoLink.attr("href", archivoUrl);
                    archivoLink.show();

                    // Muestra el nombre del archivo con el icono correspondiente
                    var archivoIcon = $("#archivoIcon");
                    var iconClass = "fa fa-file"; // Icono predeterminado

                    // Asigna el icono según la extensión del archivo
                    var extension = result.data.archivo_doc.split('.').pop().toLowerCase();
                    if (extension === "pdf") {
                        iconClass = "fa fa-file-pdf-o text-success fa-2x";
                    } else if (extension === "doc" || extension === "docx") {
                        iconClass = "fa fa-file-word-o text-primary fa-2x";
                    } else if (extension === "xls" || extension === "xlsx") {
                        iconClass = "fa fa-file-excel-o text-danger fa-2x";
                    }

                    archivoIcon.attr("class", "input-group-text " + iconClass);

                    // Muestra el nombre del archivo
                    $("#archivo").val(result.data.archivo_doc + " "); // Asigna el nombre completo del archivo
                    $("#archivo").addClass("input-with-icon");

                    // Muestra el span con el enlace y el icono
                    archivoLink.show();
                } else {
                    // Si no hay archivo, ocultar el enlace y vaciar el contenido del icono
                    $("#archivoLink").hide();
                    archivoIcon.html(""); // Vaciar el contenido del ícono
                }

                $('#modalFormSalidas').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnEliminarDocSalida(id_salida) {
    Swal.fire({
        title: '<span style="font-size: 24px; font-weight: bold;">Eliminar la salida del Documentos</span>',
        html: '<p style="font-size: 18px;">Confirma si deseas eliminar la salida del Documentoo</p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5B77F5',
        cancelButtonColor: '#FF7272',
        confirmButtonText: '<span style="font-size: 18px;">Si, eliminar</span>',
        cancelButtonText: '<span style="font-size: 18px;">No, cancelar</span>',
        customClass: {
            popup: 'custom-alert-popup',
            title: 'custom-alert-title',
            content: 'custom-alert-content',
            cancelButton: 'custom-alert-button',
            confirmButton: 'custom-alert-button'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const ajaxUrl = base_url + '/DocSalidas/deleteSalida/';
            const strData = "idSalidas=" + id_salida;
            const xhttp = new XMLHttpRequest();

            xhttp.open("POST", ajaxUrl, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(strData);
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    const result = JSON.parse(xhttp.responseText);
                    if (result.status) {
                        Swal.fire({
                            icon: 'success',
                            title: '<span style="font-size: 24px; font-weight: bold;">¡Éxito!</span>',
                            html: '<p style="font-size: 18px;">Salida del Documento eliminado con éxito.</p>',
                            timer: 3000,
                            timerProgressBar: true,
                            confirmButtonColor: '#28a745',
                            background: '#f9f9f9',
                            customClass: {
                                popup: 'custom-alert-popup',
                                title: 'custom-alert-title',
                                confirmButton: 'custom-alert-button'
                            }
                        });
                        tableDocSalida.api().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '<span style="font-size: 24px; font-weight: bold;">Error</span>',
                            html: '<p style="font-size: 18px;">' + result + '</p>',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'Aceptar',
                            background: '#f9f9f9',
                            customClass: {
                                popup: 'custom-alert-popup',
                                title: 'custom-alert-title',
                                confirmButton: 'custom-alert-button'
                            }
                        });
                    }

                }
            }
        }
    })
}
