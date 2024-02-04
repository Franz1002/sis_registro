var tableDocumentos;

document.addEventListener('DOMContentLoaded', function () {

    tableDocumentos = $('#tableDocumentos').dataTable({
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
            "url": " " + base_url + "/Documentos/getDocumentos",
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
            { "data": "id_doc" },
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
                    return '<a href="/sis_registro/Assets/archivos_doc/' + data + '" target="_blank">' + icono + '</a>';
                }
            },
            { "data": "options" }

        ],
        "responsive": "true",

        "bDestroy": true,

        "order": [[0, "asc"]]
    });


});
function obtenerIconoArchivo2(nombreArchivo) {
    var extension = nombreArchivo.substr(nombreArchivo.lastIndexOf('.') + 1).toLowerCase();
    var nombreSinExtension = nombreArchivo.substr(0, nombreArchivo.lastIndexOf('.'));
    var nombreRecortado = nombreSinExtension.substring(0, 10);

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

    return '<p style="display: inline; vertical-align: middle; font-size: 14px; margin: 0px 30px 0px 10px;' +
        '<a href="/sis_registro/Assets/archivos_doc/' + nombreArchivo + '" target="_blank" title="' + archivoCompleto + '">' +
        icono + ' <span style="margin-left: 2px;">' + nombreRecortado + '.' + '.' + extension +
        '</a>' +
        '<p';
}

function obtenerIconoArchivo(nombreArchivo) {
    var extension = nombreArchivo.substr(nombreArchivo.lastIndexOf('.') + 1).toLowerCase();
    var icono = '';

    switch (extension) {
        case 'pdf':
            icono = '<i class="fa fa-file-pdf-o text-success fa-2x"></i>'; // Icono de PDF de Font Awesome
            break;
        case 'doc':
        case 'docx':
            icono = '<i class="fa fa-file-word-o text-primary fa-2x"></i>'; // Icono de Word de Font Awesome
            break;
        case 'xls':
        case 'xlsx':
            icono = '<i class="fa fa-file-excel-o text-danger fa-2x"></i>'; // Icono de Excel de Font Awesome
            break;
        // Agrega más casos según las extensiones de archivo que quieras reconocer y mostrar iconos
        default:
            icono = '<i class="fa fa-file-o text-primary fa-2x"></i>'; // Icono genérico de archivo de Font Awesome
            break;
    }

    // Envuelve el icono y el texto en un span y aplica el estilo de alineación vertical
    return '<span style="display: inline-block; vertical-align: middle;">' + icono + ' ' + '</span>';
}

function openModalDocumentos() {
    document.querySelector('#idDocumento').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-dark");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Documento";
    document.querySelector("#formDocumento").reset();

    // Llamar a obtenerUltimaHojaDeRuta solo cuando se va a utilizar el valor
    obtenerUltimaHojaDeRuta().then(ultimaHoja => {
        const nuevoNumero = obtenerNuevoNumero(ultimaHoja);
        const nuevaHojaDeRuta = generarNuevaHojaDeRuta(nuevoNumero);
        document.getElementById("codigoHojaRuta").value = nuevaHojaDeRuta;
    });

    $('#modalFormDocumento').modal('show');

}


// Llamar a fntAreasTotal y obtenerUltimaHojaDeRuta cuando la página se haya cargado completamente
window.addEventListener('load', function () {
    fntAreasTotal();
}, false);


function fntAreasTotal() {
    if (document.querySelector('#listArea')) {
        const ajaxUrl = base_url + '/Areas/getSelectAreas';
        const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listArea').innerHTML = request.responseText;
                //document.querySelector('#listArea').value = 1; selecciona el primer elemento del select
                $('#listArea').selectpicker('render');
            }
        }
    }

}

function registrarDoc(e) {
    e.preventDefault();

    const intIdDoc = document.querySelector('#idDocumento').value;
    const strTitulo = document.getElementById("txtTitulo");
    const usuarioIdInput = document.getElementById("usuarioId");
    const intArea = document.getElementById("listArea");
    const strRemitente = document.getElementById("txtRemitente");
    const strFechaR = document.querySelector('#txtFechaHoraR').value;
    const strArchivo = document.getElementById("archivoDocumento");
    const usuarioId = usuarioIdInput.value;

    obtenerUltimaHojaDeRuta().then(ultimaHoja => {
        const nuevoNumero = obtenerNuevoNumero(ultimaHoja);
        const nuevaHojaDeRuta = generarNuevaHojaDeRuta(nuevoNumero);

        if (strTitulo.value == "" || nuevaHojaDeRuta == "" || usuarioId == "" || intArea.value == ""
            || strRemitente.value == "" || strFechaR == "" || strArchivo == null) {
            Swal.fire({
                icon: 'error',
                showCloseButton: true,
                title: '<span style="color: #ff4d4d; font-size: 32px; font-weight: bold;">¡ATENCIÓN!</span>',
                html: `
                      <div style="font-size: 28px; color: #707070; margin-top: 10px;">
                        <p style="margin: 0;">Por favor, complete todos los campos marcados en</p>
                        <p style="margin: 0;">rojo para poder continuar.</p>
                      </div>
                    `,
                timer: 7000,
                timerProgressBar: true,
                background: '#f8f8f8', /* Fondo gris claro */
                backdrop: `
                      rgba(255, 0, 0, 0.1) left top no-repeat
                    `
            });


        } else {
            const xhttp = new XMLHttpRequest();
            const ajaxUrl = base_url + '/Documentos/setDoc';


            const formData = new FormData();
            formData.append('idDocumento', intIdDoc);
            formData.append('txtTitulo', strTitulo.value);
            formData.append('codigoHojaRuta', nuevaHojaDeRuta);
            formData.append('usuarioId', parseInt(usuarioId));
            formData.append('listArea', intArea.value);
            formData.append('txtRemitente', strRemitente.value);
            formData.append('txtFechaHoraR', strFechaR);
            formData.append('archivoDocumento', strArchivo.files[0]);

            xhttp.open("POST", ajaxUrl, true)
            xhttp.send(formData);
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    const result = JSON.parse(xhttp.responseText);
                    if (result.status) {
                        Swal.fire({
                            icon: 'success',
                            title: '<span style="font-size: 24px; font-weight: bold; text-decoration: underline;">REGISTRADO</span>',
                            html: '<p style="font-size: 18px;">¡Documento registrado exitosamente!</p>',
                            showConfirmButton: true,
                            timer: 3000,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                            background: '#f9f9f9',
                            customClass: {
                                popup: 'custom-alert-popup',
                                title: 'custom-alert-title',
                                confirmButton: 'custom-alert-button'
                            }
                        });
                        $('#modalFormDocumento').modal("hide");
                        formDocumento.reset();
                        tableDocumentos.api().ajax.reload();
                    } else if (result.statuss) {

                        Swal.fire({
                            icon: 'success',
                            title: '<span style="font-size: 24px; font-weight: bold; text-decoration: underline;">EDITADO</span>',
                            html: '<p style="font-size: 18px;">¡Documento editado exitosamente!</p>',
                            showConfirmButton: true,
                            timer: 4000,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                            background: '#f9f9f9',
                            customClass: {
                                popup: 'custom-alert-popup',
                                title: 'custom-alert-title',
                                confirmButton: 'custom-alert-button'
                            }
                        });
                        $('#modalFormDocumento').modal("hide");
                        formDocumento.reset();
                        tableDocumentos.api().ajax.reload();

                    } else if (result.statusss) {
                        Swal.fire({
                            icon: 'error',
                            title: '<strong><u>Error</u></strong>',
                            html: '<h2>El Documento ya existe</h2>',
                            showConfirmButton: true,
                            timer: 4000

                        });
                    }


                }
            };
        }

    });

}

// Función para obtener la última hoja de ruta del servidor
function obtenerUltimaHojaDeRuta() {
    return new Promise((resolve, reject) => {
        // Realizar una solicitud AJAX para obtener la última hoja de ruta
        const ajaxUrl = base_url + '/Documentos/obtenerUltimaHojaDeRuta'; // Ajusta la URL a la correcta

        const xhr = new XMLHttpRequest();
        xhr.open('GET', ajaxUrl, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const respuestaServidor = JSON.parse(xhr.responseText);
                resolve(respuestaServidor.ultimaHoja);
            }
        };
        xhr.send();
    });
}

// Función para obtener el nuevo número basado en la última hoja de ruta
function obtenerNuevoNumero(ultimaHoja) {
    // Parsear el número actual de la hoja de ruta
    const numeroActual = parseInt(ultimaHoja.split("-")[1]);

    // Incrementar el número
    const nuevoNumero = numeroActual + 1;

    return nuevoNumero;
}

// Función para generar una nueva hoja de ruta con el nuevo número
function generarNuevaHojaDeRuta(nuevoNumero) {
    const fechaActual = new Date();
    const year = fechaActual.getFullYear();
    const month = (fechaActual.getMonth() + 1).toString().padStart(2, "0");
    const day = fechaActual.getDate().toString().padStart(2, "0");
    const nuevoNumeroPadded = nuevoNumero.toString().padStart(3, "0");
    return `${year}${month}${day}-${nuevoNumeroPadded}`;
}


function btnVerDocumento(id_doc) {
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

                $('#modalVerDocumento').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function btnEditarDocumento(id_doc) {
    document.getElementById("titleModal").innerHTML = "Actualizar datos del Documento";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("btnText").innerHTML = " Actualizar";
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = base_url + '/Documentos/getDocumento/' + id_doc;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);

            if (result.status) {
                document.getElementById("idDocumento").value = result.data.id_doc;
                document.getElementById("txtTitulo").value = result.data.titulo_doc;
                document.getElementById("codigoHojaRuta").value = result.data.hojaderuta;
                document.getElementById("txtUsuario").value = result.data.usuario;
                document.getElementById("listArea").value = result.data.area_id;
                document.getElementById("txtRemitente").value = result.data.remitente_doc;

                const archivoDocumento = document.getElementById("archivoDocumento");
                const nombreArchivoActual = document.getElementById("nombreArchivoActual");

                archivoDocumento.addEventListener("change", function () {
                    if (this.files.length > 0) {
                        // Si hay un archivo seleccionado, actualizar el nombre en el span y el ícono
                        const nombreArchivo = this.files[0].name;
                        nombreArchivoActual.innerHTML = obtenerIconoArchivo(nombreArchivo) + ' ' + nombreArchivo;
                    } else {
                        // Si no se subió un nuevo archivo, mostrar el nombre del archivo actual en la base de datos
                        nombreArchivoActual.innerHTML = obtenerIconoArchivo(result.data.archivo_doc) + result.data.archivo_doc;
                    }
                });

                if (archivoDocumento && archivoDocumento.files.length > 0) {
                    // Si hay un archivo seleccionado, actualizar el nombre en el span y el ícono
                    const nombreArchivo = archivoDocumento.files[0].name;
                    nombreArchivoActual.innerHTML = obtenerIconoArchivo(nombreArchivo) + ' ' + nombreArchivo;
                } else {
                    // Si no se subió un nuevo archivo, mostrar el nombre del archivo actual en la base de datos
                    nombreArchivoActual.innerHTML = obtenerIconoArchivo(result.data.archivo_doc) + ' ' + result.data.archivo_doc;
                }

                $('#listArea').selectpicker('render');
                $('#modalFormDocumento').modal('show');
            } else {
                swal("Error", result.msg, "error");
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
                        tableDocumentos.api().ajax.reload();
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
