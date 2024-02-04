<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?= $data['page_title'] ?>
    </title>

    <!-- Bootstrap -->
    <link href="<?= media(); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= media(); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= media(); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= media(); ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= media(); ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form class="login-form" name="formLogin" id="formLogin" action="">
                        <h1>    
                            LOGIN DEL SISTEMA
                        </h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Correo electrónico" id="txtEmailLog"
                                name="txtEmailLog" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Contraseña" id="txtPasswordLog"
                                name="txtPasswordLog" required="" />
                        </div>
                        <div id="alertLogin" class="text-center"></div>
                        <div class="form-group btn-container">
                            <button type="submit" class="btn btn-secondary btn-block" onclick="enterLogin(event);"><i
                                    class="fa fa-sign-in"></i>INICIAR SESIÓN</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">No tienes cuenta?
                                <a href="#signup" class="to_register"> Crear cuenta </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-file-archive-o"></i>
                                    <?= $data['page_tag'] ?>
                                </h1>
                                <a> ©2023 ITSA - Proyecto de grado by <a href="https://colorlib.com">Camila Salinas
                                        Yarhui</a>


                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form>
                        <h1>Crear Cuenta</h1>

                        <div>
                            <input type="email" class="form-control" placeholder="Correo electrónico" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Contraseña" required="" />
                        </div>
                        <div class="form-group btn-container">
                            <button type="submit" class="btn btn-secondary btn-block"><i
                                    class="fa fa-sign-in"></i>CREAR</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Ya tienes una cuenta??
                                <a href="#signin" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <script>
        const base_url = "<?= base_url(); ?>";
    </script>
    <!-- jQuery -->
    <script src="<?= media(); ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= media(); ?>/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?= media(); ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= media(); ?>/vendors/nprogress/nprogress.js"></script>

    <!-- dataTAble -->
    <script src="<?= media(); ?>/dataTables/datatables.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?= media(); ?>/build/js/custom.min.js"></script>

    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>

    <!-- sweetalert js -->
    <script src="<?= media(); ?>/Alert/dist/sweetalert2.all.min.js"></script>

</body>

</html>