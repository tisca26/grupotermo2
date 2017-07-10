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
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
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
                                <h1>Camiones</h1>
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
                                    <a href="<?php echo base_url('camiones'); ?>">Camiones</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Agregar Camiones</span>
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
                                                    <span class="caption-subject font-dark sbold uppercase">Alta de Camiones</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <?php echo get_bootstrap_alert(); ?>
                                                <?php echo validation_errors("<div class='alert alert-danger'>", "</div>"); ?>
                                                <?php echo form_open('camiones/frm_insertar', array('class' => 'horizontal-form', 'id' => 'form1')); ?>
                                                <div class="form-body">
                                                    <div class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button>
                                                        Tiene errores en su formulario
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"> Placa
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_placa = [
                                                                    'id' => 'placa',
                                                                    'placeholder' => 'Placa del camion',
                                                                    'class' => 'form-control',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-rule-minlength' => '3',
                                                                    'data-msg-minlength' => 'Mínimo debe tener {0} caracteres'
                                                                ]; ?>
                                                                <?php echo form_input('placa', set_value('placa'), $data_placa); ?>
                                                                <span class="help-block"> Placa del camion </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"> Chofer
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_chofer = [
                                                                    'id' => 'nombre_chofer',
                                                                    'placeholder' => 'Chofer del camion',
                                                                    'class' => 'form-control',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-rule-minlength' => '3',
                                                                    'data-msg-minlength' => 'Mínimo debe tener {0} caracteres'
                                                                ]; ?>
                                                                <?php echo form_input('nombre_chofer', set_value('nombre_chofer'), $data_chofer); ?>
                                                                <span class="help-block"> Chofer del camion </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"> Proveedor
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_proveedores = [
                                                                    'id' => 'proveedores_id',
                                                                    'class' => 'form-control selectpicker',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-live-search' => "true",
                                                                    'data-size' => '5',
                                                                    'title' => '- Seleccione -',
                                                                    'data-live-search-normalize' => "true"
                                                                ];
                                                                $proveedores_sel = array();
                                                                foreach ($proveedores as $proveedor) {
                                                                    $proveedores_sel[$proveedor->proveedores_id] = $proveedor->nombre;
                                                                }
                                                                ?>
                                                                <?php echo form_dropdown('proveedores_id', $proveedores_sel, '', $data_proveedores) ?>
                                                                <span class="help-block"> Proveedor del camión </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Capacidad
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_capacidad = [
                                                                    'id' => 'capacidad',
                                                                    'placeholder' => 'Capacidad del camion',
                                                                    'class' => 'form-control',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-rule-number' => 'true',
                                                                    'data-msg-number' => 'El campo debe ser numérico'
                                                                ]; ?>
                                                                <div class="input-group">
                                                                    <?php echo form_input('capacidad', set_value('capacidad'), $data_capacidad); ?>
                                                                    <span class="input-group-addon">
                                                                        <span> m<sup>3</sup> </span>
                                                                    </span>
                                                                </div>
                                                                <span class="help-block"> Capacidad del camion </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"> Fecha de cubicación
                                                                    <span class="required"> * </span></label>
                                                                <?php $data_fecha_cubicacion = [
                                                                    'id' => 'fecha_cubicacion',
                                                                    'placeholder' => 'Fecha de inicio',
                                                                    'class' => 'form-control date-picker',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'data-rule-dateIso' => 'true',
                                                                    'data-msg-dateIso' => 'Formato incorrecto de la fecha'
                                                                ]; ?>
                                                                <?php echo form_input('fecha_cubicacion', set_value('fecha_cubicacion'), $data_fecha_cubicacion); ?>
                                                                <span class="help-block"> Fecha de cubicación del camión </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions right">
                                                    <a type="button" class="btn default"
                                                       href="<?php echo base_url('camiones'); ?>">Cancelar</a>
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
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
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
    $(document).ready(function () {
        $('.date-picker').datepicker({
            language: 'es',
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('#cat_estados_id').on('change', function(){
            var selected = $(this).find("option:selected").val();
            var my_url = "<?php echo base_url('camiones/municipios_por_estado/'); ?>" + selected;
            $.get(
                my_url
            ).done(function (data) {
                var $select = $('#cat_municipios_id');
                $select.empty();
                for (var idx in data) {
                    $select.append(
                        $("<option>").attr("value", data[idx].cat_municipios_id).text(data[idx].descripcion)
                    );
                }
                $('.selectpicker').selectpicker('refresh');
            }).fail(function () {
                alert("Error al obtener los estados");
            });
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