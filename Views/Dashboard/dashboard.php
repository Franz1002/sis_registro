<?php headerAdmin($data); ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="row">

              <div class="col-md-12 text-center">
                <h4>
                  <?= $data['page_tag']; ?>
                </h4>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <?php dep($_SESSION['userData']);

?>
          <?php if (!empty($_SESSION['userData']['rol_tu'] == 'Administrador')) { ?> 
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de Usuarios</h4>
                <hr class="card-divider" />
                <div class="card card-content2">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalUsuarios'] ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/usuarios" class="card-icon-link">
                    <i class="fa fa-users card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if (!empty($_SESSION['userData']['rol_tu'] == 'Administrador')) { ?> 

          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de Tipos de Usuario</h4>
                <hr class="card-divider" />
                <div class="card card-content2">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalTipos']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/rol" class="card-icon-link">
                    <i class="fa fa-users card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
          <?php if (!empty($_SESSION['userData']['rol_tu'] == 'Administrador')) { ?> 

          <!-- Card Total de Áreas -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de Áreas</h4>
                <hr class="card-divider" />
                <div class="card card-content2">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalAreas']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/areas" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
          <!-- Card Total de documentos recepcionados en el área de Recursos Humanos -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos recepcionados en el área de Recursos Humanos
                </h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalRRrhh']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/rrhh" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Ejemplo para el card Total de documentos recepcionados en el área de Sie -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos recepcionados en el área de Sie</h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalRSie'] ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/sie" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Ejemplo para el card Total de documentos recepcionados en el área de Seguimiento Urbano -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos recepcionados en el área de Seguimiento
                  Urbano</h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalRUrbano'] ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/urbano" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Ejemplo para el card Total de documentos recepcionados en el área de Seguimiento Rural -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos recepcionados en el área de Seguimiento
                  Rural</h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalRRural'] ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/rural" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Card Total de documentos recepcionados en el área de Participación Social -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos recepcionados en el área de Participación
                  Social</h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalRSocial']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/social" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>        
          <!-- Ejemplo para el card Registro total de documentos recepcionados en todas las áreas -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Registro documentos recepcionados en todas las áreas
                </h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalRecepcionados']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/documentos" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>


          <!-- Ejemplo para el card Total de documentos enviados desde el área de Recursos Humanos -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos enviados desde el área de Recursos Humanos
                </h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalSRrhh']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/docSalidas" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Card Total de documentos enviados desde el área de Sie -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos enviados desde el área de Sie</h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalSSie']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/docSalidas" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Ejemplo para el card Total de documentos enviados desde el área de Seguimiento Urbano -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos enviados desde el área de Seguimiento Urbano
                </h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalSUrbano']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/docSalidas" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Ejemplo para el card Total de documentos enviados desde el área de Seguimiento Rural -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos enviados desde el área de Seguimiento Rural
                </h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalSRural']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/docSalidas" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Ejemplo para el card Total de documentos enviados desde el área de Participación Social -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Total de documentos enviados desde el área de Participación
                  Social</h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <?= $data['totalSSocial']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/docSalidas" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
       
          <!-- Ejemplo para el card Total de documentos enviados desde el área de Participación Social -->
          <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <h4 class="card-title card-title-white">Registro total de salidas de documentos en todas las áreas</h4>
                <hr class="card-divider" />
                <div class="card card-content">
                  <p class="card-text card-total">
                    Total registrado:
                    <span class="card-total-number">
                      <!-- Coloca aquí el valor del total de documentos enviados desde el área de Participación Social -->
                      <?= $data['totalSalidas']; ?>
                    </span>
                  </p>
                  <a href="<?php echo base_url(); ?>/docSalidas" class="card-icon-link">
                    <i class="fa fa-building card-icon" style="font-size: 42px;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>



<!-- /page content -->

<!-- footer content -->
<footer>
  <div class="pull-right">
    ITSA - Proyecto de grado by <a href="https://colorlib.com">Camila Salinas Yarhui</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<?php footerAdmin($data); ?>