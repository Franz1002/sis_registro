function enterLogin(e) {
    e.preventDefault();
    const strUser = document.getElementById("txtEmailLog");
    const strPassword = document.getElementById("txtPasswordLog");
    if (strUser.value == "" || strPassword.value == "") {
        Swal.fire({
            icon: 'error',
            showCloseButton: true,
            title: 'Error!',
            text: 'El correo y la contraseña son obligatorios',
            color: '#716add',
            timer: '5000',
            timerProgressBar: 'true',
            background: '#fffff',
            backdrop: `
                      rgba(2,0,106,0.3)                     
                      left top
                      no-repeat
                  `
        });

    } else {
        const xhttp = new XMLHttpRequest();
        const ajaxUrl = base_url+'/Login/loginUser';
        const form = document.getElementById("formLogin");

        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        console.log(xhttp);
        xhttp.onreadystatechange = function () {
            console.log(xhttp);
            if (xhttp.readyState != 4) return;
            if (xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result == 1) {
                    window.location = base_url + '/dashboard';
                } else {
                    Swal.fire({
                        icon: 'error',
                        showCloseButton: true,
                        title: 'Error!',
                        text: 'El correo o la contraseña son incorrectos',
                        color: '#716add',
                        timer: '5000',
                        timerProgressBar: 'true',
                        background: '#fffff',
                        backdrop: `
                                              rgba(2,0,106,0.3)                     
                                              left top
                                              no-repeat
                                          `
                    });
                
                    document.querySelector('#password').value = "";
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    showCloseButton: true,
                    title: 'Error!',
                    text: 'El correo o la contraseña son incorrectos',
                    color: '#716add',
                    timer: '5000',
                    timerProgressBar: 'true',
                    background: '#fffff',
                    backdrop: `
                                          rgba(2,0,106,0.3)                     
                                          left top
                                          no-repeat
                                      `
                });
                document.querySelector('#txtPasswordLog').value = "";
            }
        }
    }
}
