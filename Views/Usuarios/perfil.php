<?php headerAdmin($data);
?>
<!-- /page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">

                    <div class="x_content">
                        <div class="col-md-3 col-sm-3  profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <?php if (!empty($_SESSION['userData']['id_usuario'] == '1')) { ?>
                                        <img class="profile_pic3" src="<?= media(); ?>/images/perfil1.jpeg" alt="Avatar"
                                            title="Change the avatar">
                                    <?php } else { ?>
                                        <img class="profile_pic2" src="<?= media(); ?>/images/perfil2.jpeg" alt="Avatar"
                                            title="Change the avatar">
                                        <?php
                                    } ?>




                                </div>
                            </div>
                            <h3>
                                <?= $_SESSION['userData']['nombres_usuario'] . ' ' . $_SESSION['userData']['apellidos_usuario'] ?>
                            </h3>

                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> Bolivia - Cbba - Sacaba
                                </li>

                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i>
                                    <?= $_SESSION['userData']['rol_tu']; ?>
                                </li>

                                <li class="m-top-xs">
                                    <i class="fa fa-external-link user-profile-icon"></i>
                                    <a href="https://sacaba.gob.bo/" target="_blank">
                                        <?= $_SESSION['userData']['email_usuario']; ?>
                                    </a>
                                </li>
                            </ul>

                            <br /> <br /> <br />
                        </div>

                        <div class="col-md-9 col-sm-9" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                        data-toggle="tab" aria-expanded="true">DATOS PERSONALES</a>
                                </li>


                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane active " id="tab_content1"
                                    aria-labelledby="home-tab">

                                    <!-- start recent activity -->
                                    <ul class="messages">

                                        <div class="col-md-12">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="user-timeline">
                                                    <div class="timeline-post">

                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width:250px;">Cédula de identidad:</td>
                                                                    <td>
                                                                        <?= $_SESSION['userData']['ci_usuario']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nombres:</td>
                                                                    <td>
                                                                        <?= $_SESSION['userData']['nombres_usuario']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Apellidos:</td>
                                                                    <td>
                                                                        <?= $_SESSION['userData']['apellidos_usuario']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cuenta de usuario:</td>
                                                                    <td>
                                                                        <?= $_SESSION['userData']['email_usuario']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Teléfono:</td>
                                                                    <td>
                                                                        <?= $_SESSION['userData']['telefono_usuario']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tipo de usuario:</td>
                                                                    <td>
                                                                        <?= $_SESSION['userData']['rol_tu']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Estado:</td>
                                                                    <td>
                                                                        <?php if ($_SESSION['userData']['estado_usuario'] == 1) {
                                                                            echo '<span class="badge badge-success">Activo</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-success">Activo</span>';
                                                                        }
                                                                        ; ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer content -->
<footer>
    <div class="pull-right">
        <a> ITSA - Proyecto de grado by <a href="https://colorlib.com">Camila Salinas Yarhui</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<?php footerAdmin($data); ?>