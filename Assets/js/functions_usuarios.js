var tableUsuarios;

document.addEventListener('DOMContentLoaded', function () {

    tableUsuarios = $('#tableUsuarios').dataTable({
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
            "url": " " + base_url + "/Usuarios/getUsuarios",
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
            { "data": "id_usuario" },
            { "data": "nombres_usuario" },
            { "data": "apellidos_usuario" },
            { "data": "ci_usuario" },
            { "data": "email_usuario" },
            { "data": "rol_tu" },
            { "data": "estado_usuario" },
            { "data": "options" }
        ],
        "responsive": "true",

        "bDestroy": true,

        "order": [[0, "asc"]]
    });


});

function openModalUsuario() {

    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-dark");
    document.querySelector('#btnText').innerHTML = " Registrar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}
window.addEventListener('load', function () {
    fntRolesUsuario();

}, false);

function fntRolesUsuario() {
    if (document.querySelector('#listRol')) {
        const ajaxUrl = base_url + '/Rol/getSelectCargos';
        const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listRol').innerHTML = request.responseText;
                //document.querySelector('#listRolid').value = 1; selecciona el primer elemento del select
                $('#listRol').selectpicker('render');

            }
        }
    }

}


function registrarUsuario(e) {
    e.preventDefault();

    const intIdUsuario = document.querySelector('#idUsuario').value;
    const strNombres = document.getElementById("txtNombre");
    const strApellidos = document.getElementById("txtApellido");
    const strCedula = document.getElementById("txtCi");
    const intCelular = document.getElementById("txtCelular");
    const strEmail = document.getElementById("txtEmail");
    const strPassword = document.getElementById("txtPass");
    const intTipoUsuario = document.getElementById("listRol");
    const intEstado = document.getElementById("listStatus");
    if (strNombres.value == "" || strApellidos.value == "" || strCedula.value == ""
        || intCelular.value == "" || intCelular.value == "" || strEmail.value == "" || strPassword.value == ""
        || intTipoUsuario.value == "" || intEstado == "") {
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
        const ajaxUrl = base_url + '/Usuarios/setUsuario';
        const form = document.getElementById("formUsuario");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<span style="font-size: 24px; font-weight: bold; text-decoration: underline;">REGISTRADO</span>',
                        html: '<p style="font-size: 18px;">¡Usuario registrado exitosamente!</p>',
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
                    $('#modalFormUsuario').modal("hide");
                    formUsuario.reset();
                    tableUsuarios.api().ajax.reload();
                } else if (result.statuss) {
                    Swal.fire({
                        icon: 'success',
                        title: '<span style="font-size: 24px; font-weight: bold; text-decoration: underline;">EDITADO</span>',
                        html: '<p style="font-size: 18px;">¡Usuario editado exitosamente!</p>',
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
                    $('#modalFormUsuario').modal("hide");
                    formUsuario.reset();
                    tableUsuarios.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<span style="font-size: 24px; font-weight: bold; text-decoration: underline;">Error</span>',
                        html: '<p style="font-size: 18px;">El Usuario ya existe</p>',
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
function btnVerUsuario(id_usuario) { //para extraer datos del usuario
    const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    const ajaxUrl = base_url + '/Usuarios/getUsuario/' + id_usuario;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            const objData = JSON.parse(request.responseText);

            if (objData.status) {
                const estadoUsuario = objData.data.estado_usuario == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-secondary">Inactivo</span>';

                document.querySelector("#verNombres").innerHTML = objData.data.nombres_usuario;
                document.querySelector("#verApellidos").innerHTML = objData.data.apellidos_usuario;
                document.querySelector("#verCI").innerHTML = objData.data.ci_usuario;
                document.querySelector("#verEmail").innerHTML = objData.data.email_usuario;
                document.querySelector("#verTelefono").innerHTML = objData.data.telefono_usuario;
                document.querySelector("#verTipoUsuario").innerHTML = objData.data.rol_tu;
                document.querySelector("#verEstado").innerHTML = estadoUsuario;
                $('#modalVerUsuario').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}



function btnEditarUsuario(id_usuario) {
    document.getElementById("titleModal").innerHTML = "Actualizar datos del Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("btnText").innerHTML = "Actualizar";
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = base_url + '/Usuarios/getUsuario/' + id_usuario;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);
            if (result.status) {
                document.getElementById("idUsuario").value = result.data.id_usuario;
                document.getElementById("txtNombre").value = result.data.nombres_usuario;
                document.getElementById("txtApellido").value = result.data.apellidos_usuario;
                document.getElementById("txtCi").value = result.data.ci_usuario;
                document.getElementById("txtCelular").value = result.data.telefono_usuario;
                document.getElementById("txtEmail").value = result.data.email_usuario;
                document.getElementById("txtPass").value = result.data.password_usuario;
                document.getElementById("listRol").value = result.data.id_tu;
                $('#listRol').selectpicker('render');

                if (result.data.estado_usuario == 1) {
                    document.getElementById("list").value = 1;
                } else {
                    document.getElementById("list").value = 2;
                }

                $('#list').selectpicker('render');
                $('#modalFormUsuario').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnEliminarUsuario(id_usuario) {
    Swal.fire({
        title: '<span style="font-size: 24px; font-weight: bold;">Eliminar Usuario</span>',
        html: '<p style="font-size: 18px;">Confirma si deseas eliminar al Usuario</p>',
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
            const ajaxUrl = base_url + '/Usuarios/deleteUsuario/';
            const strData = "idUsuario=" + id_usuario;
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
                            html: '<p style="font-size: 18px;">Usuario eliminado con éxito.</p>',
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
                        tableUsuarios.api().ajax.reload();
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


//Actualizar Perfil

    if (document.querySelector("#formPerfil")) {
        const formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function (e) {
            e.preventDefault();
            const strIdentificacion = document.querySelector('#txtCi').value;
            const strNombre = document.querySelector('#txtNombre').value;
            const strApellido = document.querySelector('#txtApellido').value;
            const intTelefono = document.querySelector('#txtCelular').value;
            const strEmail = document.querySelector('#txtEmail').value;
            const strPassword = document.querySelector('#txtPass').value;
            const strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;

            if (strIdentificacion == '' || strEmail == '' || strNombre == '' || strApellido == '' || intTelefono == '') {
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
            }

            if (strPassword != "" || strPasswordConfirm != "") {
                if (strPassword != strPasswordConfirm) {
                    Swal.fire({
                        title: '<strong>Atención!</strong>',
                        icon: 'info',
                        html:
                            'Las contraseñas no son iguales</b>'
                        ,
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,

                    })
                    return false;
                }
                if (strPassword.length < 5) {
                    Swal.fire({
                        title: '<strong>Atención!</strong>',
                        icon: 'info',
                        html:
                            'Las contraseñas deben tener 5 carácteres mínimos</b> '
                        ,
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,

                    })
                    return false;
                }
            }   

            const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            const ajaxUrl = base_url + '/Usuarios/putPerfil';
            const formData = new FormData(formPerfil);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    const objData = JSON.parse(request.responseText);
                    if (objData.status) {

                        Swal.fire({
                            icon: 'success',
                            title: '<strong><u>MODIFICADO</u></strong>',
                            html: '<h2>Datos modificado exitósamente</h2>',
                            showConfirmButton: true,
                            timer: 4000
                        });
                  
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                return false;
            }
        }
    }
