var tableDocumentosSie;

document.addEventListener('DOMContentLoaded', function () {

    tableDocumentosSie = $('#tableDocumentosSie').dataTable({
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
            "url": " " + base_url + "/Sie/getDocumentosSie",
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
            { "data": "hojaderuta" },
            { "data": "titulo_doc" },
            { "data": "usuario" },
            { "data": "nombre_area" },
            { "data": "remitente_doc" },
            { "data": "fecha_recepcion" },
            {
                "data": "archivo_doc",
                "render": function (data, type, row) {
                    var icono = obtenerIconoArchivo2(data); // Función para obtener el ícono según la extensión del archivo
                    return '<a href="/sis_registro/Assets/archivos_doc/SIE/' + data + '" target="_blank">' + icono + '</a>';
                }
            },
            { "data": "options" }

        ],
        "responsive": "true",

        "bDestroy": true,

        "order": [[0, "asc"]]
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

    return '<span style="display: inline-block; vertical-align: middle;">' +
        '<a href="/sis_registro/Assets/archivos_doc/' + nombreArchivo + '" target="_blank" title="' + archivoCompleto + '">' +
        icono + ' ' + nombreRecortado + '.' + '.' + extension +
        '</a>' +
        '</span>';
}
function btnVerDocumentoSie(id_doc) {
    const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    const ajaxUrl = base_url + '/Documentos/getDocumento/' + id_doc;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            const objData = JSON.parse(request.responseText);

            if (objData.status) {
                document.querySelector("#verTituloDocumento").innerHTML = objData.data.titulo_doc;
                document.querySelector("#verHojaDeRuta").innerHTML = objData.data.hojaderuta;
                document.querySelector("#verUsuario").innerHTML = objData.data.usuario;
                document.querySelector("#verArea").innerHTML = objData.data.nombre_area;
                document.querySelector("#verRemitente").innerHTML = objData.data.remitente_doc;
                document.querySelector("#verFechaRecepcion").innerHTML = objData.data.fecha_recepcion;

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
                    let icono = "fa fa-file-o text-primary fa-5x"; // Por defecto, ícono de archivo genérico
                    if (extension === "pdf") {
                        icono = "fa fa-file-pdf-o text-success fa-5x";
                    } else if (extension === "doc" || extension === "docx") {
                        icono = "fa fa-file-word-o text-primary fa-5x";
                    } else if (extension === "xls" || extension === "xlsx") {
                        icono = "fa fa-file-excel-o text-danger fa-5x";
                    }
                    archivoEnlace.innerHTML = `<i class="fas ${icono}"></i> ${objData.data.archivo_doc}`;
                    document.querySelector("#verArchivo").innerHTML = ""; // Vaciar contenido actual
                    document.querySelector("#verArchivo").appendChild(archivoEnlace); // Agregar nuevo enlace
                } else {
                    document.querySelector("#verArchivo").innerHTML = "No hay archivo adjunto.";
                }

                $('#modalVerDocumentoSie').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function btnEliminarDocumento(id_doc) {
    Swal.fire({
        title: '<span style="font-size: 24px; font-weight: bold;">Eliminar Documento</span>',
        html: '<p style="font-size: 18px;">Confirma si deseas eliminar el Documento</p>',
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
            const ajaxUrl = base_url + '/Documentos/deleteDocumento/';
            const strData = "idDocumento=" + id_doc;
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
                            html: '<p style="font-size: 18px;">Documento eliminado con éxito.</p>',
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
                        tableDocumentosSie.api().ajax.reload();
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