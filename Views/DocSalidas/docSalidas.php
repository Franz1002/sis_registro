<?php headerAdmin($data);
getModal('modalSalidas', $data);
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <div class="row">
              <div class="col-md-4">
                <button type="button" class="btn btn-dark" onclick="openModalSalidas();"><i
                    class="fa fa-plus-circle"></i> Registrar Salidas</button>
              </div>
              <div class="col-md-4 text-center">
                <h4>
                  <?= $data['page_tag']; ?>
                </h4>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div class="row">
              <div class="col-md-12">
                <div class="tile">
                  <div class="tile-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered" id="tableDocSalida">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Entregado por</th>
                            <th>Área</th>
                            <th>Entregado a</th>
                            <th>Fecha y hora entregado</th>
                            <th>Archivo</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
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
    <a> ITSA - Proyecto de grado by <a href="https://colorlib.com">Camila Salinas Yarhui</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<?php footerAdmin($data); ?>