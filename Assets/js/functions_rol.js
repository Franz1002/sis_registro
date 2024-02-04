var tableRol;

document.addEventListener('DOMContentLoaded', function () {

    tableRol = $('#tableRol').dataTable({
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
            "url": " " + base_url + "/Rol/getRoles",
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
            { "data": "id_tu" },
            { "data": "rol_tu" },
            { "data": "descripcion_tu" },
            { "data": "estado_tu" },
            { "data": "options" }
        ],
        "responsive": "true",

        "bDestroy": true,

        "order": [[0, "asc"]]
    });


});



function openModalRol() {

    document.querySelector('#idRol').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-dark");
    document.querySelector('#btnText').innerHTML = " Registrar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Tipo de Usuario";
    document.querySelector("#formRol").reset();
    $('#modalFormRol').modal('show');
}

function registrarTu(e) {
    e.preventDefault();

    const intIdTu = document.querySelector('#idRol').value;
    const strRol = document.getElementById("txtNombre");
    const strDescripcion = document.getElementById("txtDescripcion");
    const intEstado = document.getElementById("listStatus");
    if (strRol.value == "" || strDescripcion.value == "" || intEstado.value == "") {
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
        const ajaxUrl = base_url + '/Rol/settU';
        const form = document.getElementById("formRol");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<span style="font-size: 24px; font-weight: bold; text-decoration: underline;">REGISTRADO</span>',
                        html: '<p style="font-size: 18px;">¡Tipo de Usuario registrado exitosamente!</p>',
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

                    $('#modalFormRol').modal("hide");
                    formRol.reset();
                    tableRol.api().ajax.reload();
                } else if (result.statuss) {
                    Swal.fire({
                        icon: 'success',
                        title: '<span style="font-size: 24px; font-weight: bold; text-decoration: underline;">EDITADO</span>',
                        html: '<p style="font-size: 18px;">¡Tipo de Usuario editado exitosamente!</p>',
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

                    $('#modalFormRol').modal("hide");
                    formRol.reset();
                    tableRol.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<span style="font-size: 24px; font-weight: bold; text-decoration: underline;">Error</span>',
                        html: '<p style="font-size: 18px;">El Tipo de Usuario ya existe</p>',
                        showConfirmButton: true,
                        timer: 4000,
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
}

function btnVerTipo(id_tu) { //para extraer datos del usuario
    const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    const ajaxUrl = base_url + '/Rol/getTipo/' + id_tu;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            const objData = JSON.parse(request.responseText);

            if (objData.status) {
                const estadoTipo = objData.data.estado_tu == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-secondary">Inactivo</span>';

                document.querySelector("#verTipo").innerHTML = objData.data.rol_tu;
                document.querySelector("#verDescripcion").innerHTML = objData.data.descripcion_tu;
                document.querySelector("#verEstado").innerHTML = estadoTipo;
                $('#modalVerTipo').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}



function btnEditarTipo(id_tu) {
    document.getElementById("titleModal").innerHTML = "Actualizar Tipo de Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("btnText").innerHTML = "Actualizar";
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = base_url + '/Rol/getTipo/' + id_tu;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);
            if (result.status) {
                document.getElementById("idRol").value = result.data.id_tu;
                document.getElementById("txtNombre").value = result.data.rol_tu;
                document.getElementById("txtDescripcion").value = result.data.descripcion_tu;

                if (result.data.estado_tu == 1) {
                    document.getElementById("listStatus").value = 1;
                } else {
                    document.getElementById("listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
                $('#modalFormRol').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnEliminarTipo(id_tu) {
    Swal.fire({
        title: '<span style="font-size: 24px; font-weight: bold;">Eliminar Tipo de Usuario</span>',
        html: '<p style="font-size: 18px;">Confirma si deseas eliminar el Tipo de Usuario</p>',
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
            const ajaxUrl = base_url + '/Rol/deleteTipo/';
            const strData = "idTipo=" + id_tu;
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
                            html: '<p style="font-size: 18px;">Tipo de Usuario eliminado con éxito.</p>',
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
                        tableRol.api().ajax.reload();
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
