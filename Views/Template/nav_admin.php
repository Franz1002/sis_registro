<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url(); ?>" class="site_title"><i class="fa fa-folder"></i> <span>
                <?= $data['page_title']; ?>
              </span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">

              <img src="<?= media(); ?>/images/logo.jpg" alt="usuario" class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido(a)</span>
              <h2>
                <?= $_SESSION['userData']['nombres_usuario'] . ' ' . $_SESSION['userData']['apellidos_usuario'] ?>
              </h2>
              <h6 style="color: rgba(255, 255, 255, 0.75);">
                <?= $_SESSION['userData']['rol_tu'] ?>
              </h6>
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Página principal <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
                  </ul>
                </li>
                <?php if (!empty($_SESSION['userData']['rol_tu'] == 'Administrador')) { ?>
                  <li><a><i class="fa fa-users"></i>Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url(); ?>/usuarios">Usuarios</a></li>
                      <li><a href="<?= base_url(); ?>/rol">Cargos del usuario</a></li>
                    </ul>
                  </li>
                <?php } ?>
                <li><a><i class="fa fa-folder-open"></i> Documentos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?= base_url(); ?>/documentos">Recepcionar documentos</a>
                    </li>
                    <li><a style="color: rgba(255, 255, 255, 0.75);">Documentos por área<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="<?= base_url(); ?>/rrhh">Recursos Humanos</a>
                        </li>
                        <li class="sub_menu"><a href="<?= base_url(); ?>/urbano">Seguimiento Urbano</a>
                        </li>
                        <li class="sub_menu"><a href="<?= base_url(); ?>/rural">Seguimiento Rural</a>
                        </li>
                        <li class="sub_menu"><a href="<?= base_url(); ?>/social">Participación Social</a>
                        </li>
                        <li class="sub_menu"><a href="<?= base_url(); ?>/sie">SIE</a>
                        </li>

                      </ul>
                    </li>
                    <li><a href="<?= base_url(); ?>/docSalidas">Registro de salidas de documentos</a>
                    </li>
                  </ul>
                </li>
                <?php if (!empty($_SESSION['userData']['rol_tu'] == 'Administrador')) { ?>

                  <li><a><i class="fa fa-cogs"> </i> Ajustes<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url(); ?>/areas">Áreas</a></li>
                    </ul>
                  </li>
                <?php } ?>
                <li><a><i class="fa fa-bar-chart-o""> </i> Reportes<span class=" fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?= base_url(); ?>/reporteEntradas">Entradas de documentos</a></li>
                    <li><a href="<?= base_url(); ?>/reporteSalidas">Salidas de documentos</a></li>
                  </ul>
                </li>
                <li>
                  <a class="app-menu__item" href="<?= base_url(); ?>/login/logout">
                    <i class="app-menu__icon fa fa-power-off" aria-hidden="true"></i>
                    <span class="app-menu__label">Cerrar sesión</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                  data-toggle="dropdown" aria-expanded="false">
                  <?php if (!empty($_SESSION['userData']['id_usuario'] == '1')) { ?>
                    <img src="<?= media(); ?>/images/perfil1.jpeg" alt="user"><?= ($_SESSION['userData']['nombres_usuario']) . ' ' . ($_SESSION['userData']['apellidos_usuario']); ?>
                  <?php } else { ?>
                    <img src="<?= media(); ?>/images/perfil2.jpeg" alt="user"><?= ($_SESSION['userData']['nombres_usuario']) . ' ' . ($_SESSION['userData']['apellidos_usuario']); ?>
                  <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?= base_url(); ?>/usuarios/perfil"> Perfil</a>
                  <a class="dropdown-item" href="<?= base_url(); ?>/login/logout"><i
                      class="fa fa-power-off pull-right"></i>
                    Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->