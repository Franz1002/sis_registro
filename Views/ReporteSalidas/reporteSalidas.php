<?php headerAdmin($data);
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
                            <div class="col-md-12 text-center">
                                <h4>
                                    <?= $data['page_tag']; ?>
                                </h4>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-block">
                        <ol class="breadcrumb bg-pink mb-5">
                            <li class="breadcrumb-item active text-white">REPORTE TOTAL DE SALIDAS DE DOCUMENTOS</li>
                        </ol>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <form action="<?php echo BASE_URL; ?>/ReporteSalidas/reporteTotal" method="POST"
                                    target="_blank" class="col-md-6">
                                    <div class="form-row form-default">
                                        <div class="form-group col-md-6">
                                            <label class="float-label control-label" style="font-size: 17px;">Reporte
                                                con la lista total de registros</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn waves-effect waves-light btn-dark">GENERAR
                                                PDF</button>
                                        </div>
                                    </div>
                                </form>
                                <form action="<?php echo BASE_URL; ?>/ReporteSalidas/reporteInformeS" method="POST"
                                    target="_blank" class="col-md-6">
                                    <div class="form-row form-default">
                                        <div class="form-group col-md-6">
                                            <label class="float-label control-label" style="font-size: 17px;">Informe de
                                                resumen de Datos salientes</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn waves-effect waves-light btn-dark">GENERAR
                                                PDF</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <ol class="breadcrumb bg-pink mb-5">
                            <li class="breadcrumb-item active text-white">REPORTE POR ÁREA DE LAS SALIDAS DE DOCUMENTOS
                            </li>
                        </ol>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <form action="<?php echo BASE_URL; ?>/ReporteSalidas/reporteArea" method="POST"
                                    target="_blank">
                                    <div class="form-row form-default">
                                        <div class="form-group col-md-3">
                                            <label class="float-label control-label"style="font-size: 17px;">Área</label>

                                            <select class="form-control" data-title="Selecciona una opción"
                                                id="reporteArea" name="reporteArea" required=""></select>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="float-label control-label" style="font-size: 17px;"
                                                    for="fechasalidaD">Desde</label>
                                                <input class="form-control" type="date"
                                                    value="<?php echo date('d-m-Y'); ?>" name="fechasalidaD"
                                                    id="fechasalidaD">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="float-label control-label" style="font-size: 17px;"
                                                    for="fechasalidaH">Hasta</label>

                                                <input class="form-control" type="date"
                                                    value="<?php echo date('Y-m-d'); ?>" name="fechasalidaH"
                                                    id="fechasalidaH">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="float-label control-label"
                                                style="font-size: 17px;;">Boton</label>
                                            <button type="submit" class="btn waves-effect waves-light btn-dark">GENERAR
                                                PDF</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <ol class="breadcrumb bg-pink mb-5">
                            <li class="breadcrumb-item active text-white">REPORTE POR RANGO DE FECHA DE RECEPCIÓN DE LAS
                                SALIDAS DE DOCUMENTOS</li>
                        </ol>
                        <div class="row text-center">
                            <div class="form-group col-md-12">
                                <form action="<?php echo BASE_URL; ?>/ReporteSalidas/reporteFechaS" method="POST"
                                    target="_blank">
                                    <div class="form-row form-default" style="margin-left: 20%;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="float-label control-label" style="font-size: 17px;"
                                                    for="fechasalidaD">Desde</label>
                                                <input class="form-control" type="date"
                                                    value="<?php echo date('d-m-Y'); ?>" name="fechasalidaD"
                                                    id="fechasalidaD">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="float-label control-label" style="font-size: 17px;"
                                                    for="fechasalidaH">Hasta</label>

                                                <input class="form-control" type="date"
                                                    value="<?php echo date('Y-m-d'); ?>" name="fechasalidaH"
                                                    id="fechasalidaH">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-8">

                                                <div class="form-group text-center">
                                                    <button type="submit"
                                                        class="btn waves-effect waves-light btn-dark">GENERAR
                                                        PDF</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        </form>
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