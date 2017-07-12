<!DOCTYPE html>
<!--[if IE 8]>
<html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>Grupo Termo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Preview page of Metronic Admin Theme #3 for " name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN PAGE FIRST SCRIPTS -->
    <script src="<?php echo cdn_assets(); ?>global/plugins/pace/pace.min.js" type="text/javascript"></script>
    <!-- END PAGE FIRST SCRIPTS -->
    <!-- BEGIN PAGE TOP STYLES -->
    <link href="<?php echo cdn_assets(); ?>global/plugins/pace/themes/pace-theme-big-counter.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE TOP STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo cdn_assets(); ?>global/css/components.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo cdn_assets(); ?>layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="<?php echo cdn_assets(); ?>layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid">
<div class="page-wrapper">
    <?php echo $this->cargar_elementos_manager->carga_simple('menus/menu_completo'); ?>
    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <!-- ----------------------------------------------------- BEGIN CONTAINER ----------------------------------------------------- -->
            <div class="page-container">
                <div class="page-content-wrapper">
                    <div class="page-head">
                        <div class="container-fluid">
                            <div class="page-title">
                                <h1>Acarreos</h1>
                            </div>
                        </div>
                    </div>
                    <div class="page-content">
                        <div class="container">
                            <ul class="page-breadcrumb breadcrumb">
                                <li>
                                    <a href="<?php echo base_url(); ?>">Inicio</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('acarreos'); ?>">Acarreos</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Editar Acarreos</span>
                                </li>
                            </ul>
                            <!-- --------------------------- INICIO CONTENIDO --------------------------- -->
                            <div class="page-content-inner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light portlet-fit portlet-form ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-dark"></i>
                                                    <span class="caption-subject font-dark sbold uppercase">Alta de Acarreos</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <?php echo get_bootstrap_alert(); ?>
                                                <?php echo validation_errors("<div class='alert alert-danger'>", "</div>"); ?>
                                                <?php echo form_open('acarreos/frm_editar', array('class' => 'horizontal-form', 'id' => 'form1')); ?>
                                                <?php echo form_hidden('acarreos_id', $acarreo->acarreos_id); ?>
                                                <div class="form-body">
                                                    <div class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button>
                                                        Tiene errores en su formulario
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Folio del Vale
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_folio = [
                                                                    'id' => 'folio_vale',
                                                                    'placeholder' => 'Folio del vale para el acarreo',
                                                                    'class' => 'form-control',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-rule-minlength' => '3',
                                                                    'data-msg-minlength' => 'Mínimo debe tener {0} caracteres'
                                                                ]; ?>
                                                                <?php echo form_input('folio_vale', set_value('folio_vale', $acarreo->folio_vale), $data_folio); ?>
                                                                <span class="help-block">Folio del vale para el acarreo</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Fecha del Acarreo
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_fecha_acarreo = [
                                                                    'id' => 'fecha_acarreo',
                                                                    'placeholder' => 'Fecha de acarreo',
                                                                    'class' => 'form-control',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-rule-dateTime' => 'true',
                                                                    'data-msg-dateTime' => 'Formato incorrecto de la fecha'
                                                                ]; ?>
                                                                <div class="input-group date form_datetime form_datetime bs-datetime">
                                                                    <?php echo form_input('fecha_acarreo', set_value('fecha_acarreo', $acarreo->fecha_acarreo), $data_fecha_acarreo); ?>
                                                                    <span class="input-group-addon">
                                                                        <button class="btn default date-set"
                                                                                type="button">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                                <span class="help-block"> Fecha de acarreo </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Obra
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_obras = [
                                                                    'id' => 'obras_id',
                                                                    'class' => 'form-control selectpicker',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-live-search' => "true",
                                                                    'data-size' => '5',
                                                                    'title' => '- Seleccione -',
                                                                    'data-live-search-normalize' => "true"
                                                                ];
                                                                $obras_sel = array();
                                                                foreach ($obras as $obra) {
                                                                    $obras_sel[$obra->obras_id] = $obra->nombre;
                                                                }
                                                                ?>
                                                                <?php echo form_dropdown('obras_id', $obras_sel, $acarreo->obras_id, $data_obras) ?>
                                                                <span class="help-block"> Obra del acarreo </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Zona
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_zona = [
                                                                    'id' => 'zonas_id',
                                                                    'class' => 'form-control selectpicker',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-live-search' => "true",
                                                                    'data-size' => '5',
                                                                    'title' => '- Seleccione -',
                                                                    'data-live-search-normalize' => "true"
                                                                ];
                                                                $zonas_sel = array();
                                                                foreach ($zonas as $zona) {
                                                                    $zonas_sel[$zona->zonas_id] = $zona->nombre;
                                                                }
                                                                ?>
                                                                <?php echo form_dropdown('zonas_id', $zonas_sel, $acarreo->zonas_id, $data_zona) ?>
                                                                <span class="help-block"> Zona del acarreo </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Camión
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_camion = [
                                                                    'id' => 'camiones_id',
                                                                    'class' => 'form-control selectpicker',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-live-search' => "true",
                                                                    'data-size' => '5',
                                                                    'title' => '- Seleccione -',
                                                                    'data-live-search-normalize' => "true"
                                                                ];
                                                                $camiones_sel = array();
                                                                foreach ($camiones as $camion) {
                                                                    $camiones_sel[$camion->camiones_id] = $camion->clave . ' - ' . $camion->placa;
                                                                }
                                                                ?>
                                                                <?php echo form_dropdown('camiones_id', $camiones_sel, $acarreo->camiones_id, $data_camion) ?>
                                                                <span class="help-block"> Camión del acarreo </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Material de acarreo
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_material = [
                                                                    'id' => 'materiales_acarreos_id',
                                                                    'class' => 'form-control selectpicker',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-live-search' => "true",
                                                                    'data-size' => '5',
                                                                    'title' => '- Seleccione -',
                                                                    'data-live-search-normalize' => "true"
                                                                ];
                                                                $materiales_sel = array();
                                                                foreach ($materiales as $material) {
                                                                    $materiales_sel[$material->materiales_acarreos_id] = $material->nombre_en_obra;
                                                                }
                                                                ?>
                                                                <?php echo form_dropdown('materiales_acarreos_id', $materiales_sel, $acarreo->materiales_acarreos_id, $data_material) ?>
                                                                <span class="help-block"> Material del acarreo </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Tipo de acarreo <span
                                                                            class="required"> * </span> </label>
                                                                <div class="mt-radio-inline">
                                                                    <label class="mt-radio">
                                                                        <?php echo form_radio('tipo_acarreo', 'EXTERNO', ($acarreo->tipo_acarreo === 'EXTERNO')); ?>
                                                                        Externo
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio">
                                                                        <?php echo form_radio('tipo_acarreo', 'INTERNO', ($acarreo->tipo_acarreo === 'INTERNO')); ?>
                                                                        Interno
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Checador
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_checador = [
                                                                    'id' => 'checador',
                                                                    'placeholder' => 'Checador del acarreo',
                                                                    'class' => 'form-control',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-rule-minlength' => '3',
                                                                    'data-msg-minlength' => 'Mínimo debe tener {0} caracteres'
                                                                ]; ?>
                                                                <?php echo form_input('checador', set_value('checador', $acarreo->checador), $data_checador); ?>
                                                                <span class="help-block"> Checador del acarreo </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($acarreo->acarreos_archivos_id != 0): ?>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label"> Archivo donde se
                                                                        cargó: </label>
                                                                    <ol>
                                                                        <li>
                                                                            <a class="text-muted" target="_blank"
                                                                               href="<?php echo base_url('acarreos/ver_archivo_acarreo/' . $acarreo->acarreos_archivos_id) ?>">
                                                                                <i class="fa fa-file-excel-o"></i> Archivo Excel
                                                                            </a>
                                                                        </li>

                                                                    </ol>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-actions right">
                                                    <a type="button" class="btn default"
                                                       href="<?php echo base_url('acarreos'); ?>">Cancelar</a>
                                                    <button type="submit" class="btn blue" id="btn_submit_form1">
                                                        <i class="fa fa-check"></i> Guardar
                                                    </button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- --------------------------- FIN CONTENIDO --------------------------- -->
                        </div>
                    </div>
                </div>
                <a href="javascript:;" class="page-quick-sidebar-toggler">
                    <i class="icon-login"></i>
                </a>
                <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                    <?php echo $this->cargar_elementos_manager->carga_simple('menus/menu_right'); ?>
                </div>
                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- -----------------------------------------------------END CONTAINER ----------------------------------------------------- -->
        </div>
    </div>
    <div class="page-wrapper-row">
        <?php echo $this->cargar_elementos_manager->carga_simple('footers/footer1'); ?>
    </div>
</div>

<!--[if lt IE 9]>
<script src="<?php echo cdn_assets(); ?>global/plugins/respond.min.js"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/excanvas.min.js"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!--  PAGE LEVEL -->
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery-validation/js/additional-methods.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-select/js/bootstrap-select.min.js"
        type="text/javascript"></script>
<!-- END PAGE LEVEL -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo cdn_assets(); ?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo cdn_assets(); ?>layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    function genera_zonas_sel(obras_id) {
        var my_url = "<?php echo base_url('acarreos/zonas_por_obra/'); ?>" + obras_id;
        $.get(
            my_url
        ).done(function (data) {
            var $select = $('#zonas_id');
            $select.empty();
            for (var idx in data) {
                $select.append(
                    $("<option>").attr("value", data[idx].zonas_id).text(data[idx].nombre)
                );
            }
            $('.selectpicker').selectpicker('refresh');
        }).fail(function () {
            alert("Error al obtener las zonas");
        });
    }
    function genera_camiones_sel(obras_id) {
        var my_url = "<?php echo base_url('acarreos/camiones_por_obra/'); ?>" + obras_id;
        $.get(
            my_url
        ).done(function (data) {
            var $select = $('#camiones_id');
            $select.empty();
            for (var idx in data) {
                $select.append(
                    $("<option>").attr("value", data[idx].camiones_id).text(data[idx].clave + ' - ' + data[idx].placa)
                );
            }
            $('.selectpicker').selectpicker('refresh');
        }).fail(function () {
            alert("Error al obtener los camiones");
        });
    }
    function genera_materiales_acarreos_sel(obras_id) {
        var my_url = "<?php echo base_url('acarreos/materiales_acarreo_por_obra/'); ?>" + obras_id;
        $.get(
            my_url
        ).done(function (data) {
            var $select = $('#materiales_acarreos_id');
            $select.empty();
            for (var idx in data) {
                $select.append(
                    $("<option>").attr("value", data[idx].materiales_acarreos_id).text(data[idx].nombre_en_obra)
                );
            }
            $('.selectpicker').selectpicker('refresh');
        }).fail(function () {
            alert("Error al obtener los camiones");
        });
    }
    $(document).ready(function () {
        $.validator.addMethod("dateTime", function (value, element) {
            var stamp = value.split(" ");
            var validDate = !/Invalid|NaN/.test(new Date(stamp[0]).toString());
            var validTime = /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/i.test(stamp[1]);
            return this.optional(element) || (validDate && validTime);
        }, "Please enter a valid date and time.");

        $('.date-picker').datepicker({
            language: 'es',
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $(".form_datetime").datetimepicker({
            language: 'es',
            autoclose: true,
            format: "yyyy-mm-dd hh:ii:ss",
            fontAwesome: true,
            pickerPosition: "bottom-left"
        });
        $('#obras_id').on('change', function () {
            var selected = $(this).find("option:selected").val();
            genera_zonas_sel(selected);
            genera_camiones_sel(selected);
            genera_materiales_acarreos_sel(selected);
        });
        var form1 = $('#form1');
        var error1 = $('.alert-danger', form1);
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            errorPlacement: function (error, element) { // render error placement for each input typeW
                if (element.parents('.mt-radio-list').size() > 0 || element.parents('.mt-checkbox-list').size() > 0) {
                    if (element.parents('.mt-radio-list').size() > 0) {
                        error.appendTo(element.parents('.mt-radio-list')[0]);
                    }
                    if (element.parents('.mt-checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.mt-checkbox-list')[0]);
                    }
                } else if (element.parents('.mt-radio-inline').size() > 0 || element.parents('.mt-checkbox-inline').size() > 0) {
                    if (element.parents('.mt-radio-inline').size() > 0) {
                        error.appendTo(element.parents('.mt-radio-inline')[0]);
                    }
                    if (element.parents('.mt-checkbox-inline').size() > 0) {
                        error.appendTo(element.parents('.mt-checkbox-inline')[0]);
                    }
                } else if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else if (element.hasClass('selectpicker')) {
                    // no se coloca el mensaje de error
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                error1.show();
                App.scrollTo(error1, -200);
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                error1.hide();
                $('#btn_submit_form1').attr('disabled', 'true').text('Cargando...');
                form[0].submit(); // submit the form
            }
        });
    })
</script>
</body>

</html>