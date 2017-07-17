<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Acarreos extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index', 'zonas_por_obra', 'camiones_por_obra', 'materiales_acarreo_por_obra', 'ver_archivo_acarreo'));
        $this->set_insert_list(array('insertar', 'frm_insertar', 'carga_archcivo', 'frm_cargar_archivo'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Acarreo');
        $this->load->library('business/Camion');
        $this->load->library('business/Material_acarreo');
        $this->load->library('business/Obra');
        $this->load->library('business/Tarifa_acarreo');
        $this->load->library('business/Tarifa_suministro');
        $this->load->library('business/Zona');
    }

    public function zonas_por_obra($obra_id = 0)
    {
        $zonas = array();
        if (valid_id($obra_id)) {
            $zonas = $this->zona->zonas_por_obra_id($obra_id, get_attr_session('usr_cuenta_id'));
        }
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($zonas);
    }

    public function camiones_por_obra($obras_id = 0)
    {
        $camiones = array();
        if (valid_id($obras_id)) {
            $tarifas = $this->tarifa_acarreo->tarifas_por_obras_id(get_attr_session('usr_cuenta_id'), $obras_id);
            $proveedores_ids = array();
            foreach ($tarifas as $tarifa) {
                $proveedores_ids[] = $tarifa->proveedores_id;
            }
            $tarifas_suministros = $this->tarifa_suministro->tarifas_por_obras_id(get_attr_session('usr_cuenta_id'), $obras_id);
            foreach ($tarifas_suministros as $tarifa){
                $proveedores_ids[] = $tarifa->proveedores_id;
            }
            $camiones = $this->camion->camiones_por_proveedores_ids(get_attr_session('usr_cuenta_id'), $proveedores_ids);
        }
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($camiones);
    }

    public function materiales_acarreo_por_obra($obras_id = 0)
    {
        $materiales_acarreo = array();
        if (valid_id($obras_id)) {
            $materiales_acarreo = $this->material_acarreo->materiales_acarreos_por_obras_id(get_attr_session('usr_cuenta_id'), $obras_id);
        }
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($materiales_acarreo);
    }

    public function index()
    {
        $data['acarreos'] = $this->acarreo->acarreos_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('acarreos/acarreos_index', $data);
    }

    public function insertar()
    {
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('acarreos/acarreos_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('folio_vale', 'Folio', 'required|min_length[3]');
        $this->form_validation->set_rules('fecha_acarreo', 'Fecha', 'required');
        $this->form_validation->set_rules('camiones_id', 'Camión', 'required|integer');
        $this->form_validation->set_rules('materiales_acarreos_id', 'Material', 'required|integer');
        $this->form_validation->set_rules('zonas_id', 'Zona', 'required|integer');
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $acarreo = $this->input->post();
            $camion = $this->camion->camion_por_id_y_cuenta($acarreo['camiones_id'], get_attr_session('usr_cuenta_id'));
            $material_acarreo = $this->material_acarreo->material_acarreo_por_id_y_cuenta($acarreo['materiales_acarreos_id'], get_attr_session('usr_cuenta_id'));
            if (is_null($camion) || is_null($material_acarreo)) {
                $msg = "Error al guardar el acarreo, el material o el camión no es válido, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                redirect('acarreos/insertar');
            }
            $acarreo['costo_material'] = $this->acarreo->calculo_costo_material_con_dto($camion, $material_acarreo, $acarreo['tipo_acarreo']);
            $aux_costo_acarreo = $this->acarreo->calculo_costo_acarreo_con_dto($acarreo['obras_id'], $camion, $material_acarreo, $acarreo['tipo_acarreo']);
            if ($aux_costo_acarreo !== false) {
                $acarreo['costo_acarreo'] = $aux_costo_acarreo;
            } else {
                $msg = "Error al guardar el acarreo, el costo del acarreo no se pudo calcular por falta de tarifa, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                redirect('acarreos/insertar');
            }
            $aux_costo_suministro = $this->acarreo->calculo_costo_suministro_con_dto($acarreo['obras_id'], $camion, $material_acarreo, $acarreo['tipo_acarreo']);
            if ($aux_costo_suministro !== false){
                $acarreo['costo_suministro'] = $aux_costo_suministro;
            }else{
                $msg = "Error al guardar el acarreo, el costo del suministro no se pudo calcular por falta de tarifa, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                redirect('acarreos/insertar');
            }

            if ($this->acarreo->insertar($acarreo)) {
                $msg = "El acarreo se guardó con éxito, inserte otro o <strong><a href='" . base_url('acarreos') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            } else {
                $msg = "Error al guardar el acarreo, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('acarreos/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('acarreos');
        }
        $data['acarreo'] = $this->acarreo->acarreo_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['zonas'] = $this->zona->zonas_por_obra_id($data['acarreo']->obras_id, get_attr_session('usr_cuenta_id'));
        $tarifas = $this->tarifa_acarreo->tarifas_por_obras_id(get_attr_session('usr_cuenta_id'), $data['acarreo']->obras_id);
        $proveedores_ids = array();
        foreach ($tarifas as $tarifa) {
            $proveedores_ids[] = $tarifa->proveedores_id;
        }
        $tarifas_suministros = $this->tarifa_suministro->tarifas_por_obras_id(get_attr_session('usr_cuenta_id'), $data['acarreo']->obras_id);
        foreach ($tarifas_suministros as $tarifa){
            $proveedores_ids[] = $tarifa->proveedores_id;
        }
        $data['camiones'] = $this->camion->camiones_por_proveedores_ids(get_attr_session('usr_cuenta_id'), $proveedores_ids);
        $data['materiales'] = $this->material_acarreo->materiales_acarreos_por_obras_id(get_attr_session('usr_cuenta_id'), $data['acarreo']->obras_id);
        $this->load->view('acarreos/acarreos_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('acarreos_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('folio_vale', 'Folio', 'required|min_length[3]');
        $this->form_validation->set_rules('fecha_acarreo', 'Fecha', 'required');
        $this->form_validation->set_rules('camiones_id', 'Camión', 'required|integer');
        $this->form_validation->set_rules('materiales_acarreos_id', 'Material', 'required|integer');
        $this->form_validation->set_rules('zonas_id', 'Zona', 'required|integer');
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('acarreos_id')));
        } else {
            $acarreo = $this->input->post();
            $camion = $this->camion->camion_por_id_y_cuenta($acarreo['camiones_id'], get_attr_session('usr_cuenta_id'));
            $material_acarreo = $this->material_acarreo->material_acarreo_por_id_y_cuenta($acarreo['materiales_acarreos_id'], get_attr_session('usr_cuenta_id'));
            if (is_null($camion) || is_null($material_acarreo)) {
                $msg = "Error al guardar el acarreo, el material o el camión no es válido, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                redirect('acarreos/editar/' . $acarreo['acarreos_id']);
            }
            $acarreo['costo_material'] = $this->acarreo->calculo_costo_material_con_dto($camion, $material_acarreo, $acarreo['tipo_acarreo']);
            $aux_costo_acarreo = $this->acarreo->calculo_costo_acarreo_con_dto($acarreo['obras_id'], $camion, $material_acarreo, $acarreo['tipo_acarreo']);
            if ($aux_costo_acarreo !== false) {
                $acarreo['costo_acarreo'] = $aux_costo_acarreo;
            } else {
                $msg = "Error al guardar el acarreo, el costo del acarreo no se pudo calcular por falta de tarifa, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                redirect('acarreos/editar/' . $acarreo['acarreos_id']);
            }
            $aux_costo_suministro = $this->acarreo->calculo_costo_suministro_con_dto($acarreo['obras_id'], $camion, $material_acarreo, $acarreo['tipo_acarreo']);
            if ($aux_costo_suministro !== false){
                $acarreo['costo_suministro'] = $aux_costo_suministro;
            }else{
                $msg = "Error al guardar el acarreo, el costo del suministro no se pudo calcular por falta de tarifa, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                redirect('acarreos/editar/' . $acarreo['acarreos_id']);
            }
            if ($this->acarreo->editar($acarreo)) {
                $msg = "El acarreo se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('acarreos');
            } else {
                $msg = "Error al guardar el acarreo.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('acarreos/' . $acarreo['acarreos_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('acarreos');
        }
        if ($this->acarreo->borrado_final(array('acarreos_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('acarreos');
    }

    public function carga_archcivo()
    {
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('acarreos/acarreos_carga_archivo', $data);
    }

    public function frm_cargar_archivo()
    {
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $obras_id = $this->input->post('obras_id');
            $this->load->library('upload');
            $nombre_archivo = get_attr_session('usr_cuenta_id') . '_' . get_attr_session('usr_username') . '_' . date('Y-m-d_H_i_s');
            $config['upload_path'] = RUTA_DOCS_USR . 'acarreos/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['file_name'] = $nombre_archivo;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('input_file')) {
                $msg = $this->upload->display_errors();
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                redirect('acarreos/carga_archcivo');
            } else {
                /*$this->load->library('Lector_archivos');
                $atributos_archivo = $this->upload->data();
                $data['hoja'] = $this->lector_archivos->leer_xlsx(RUTA_DOCS_USR . 'acarreos/' . $atributos_archivo['file_name']);
                return $this->load->view('ejemplo_carga/ejemplo_carga_index', $data);*/

                $filas_erroneas = array();
                $filas_repetidas = array();
                $atributos_archivo = $this->upload->data();
                $guarda_info_carga['nombre_archivo'] = $atributos_archivo['file_name'];
                $guarda_info_carga['usuarios_id'] = get_attr_session('usr_id');
                $guarda_info_carga['obras_id'] = $obras_id;
                if ($this->acarreo->insertar_acarreos_archivos($guarda_info_carga) !== false) {
                    $archivo_id = $this->acarreo->ultimo_id();

                    $this->load->library('Lector_archivos');
                    $hoja = $this->lector_archivos->leer_xlsx(RUTA_DOCS_USR . 'acarreos/' . $atributos_archivo['file_name']);
                    foreach ($hoja as $num_fila => $fila) {
                        if ($num_fila == 1) {
                            continue; //saltamos la primera fila
                        }
                        if (trim($fila['A']) == '') {
                            break;
                        }
                        $fila = array_filter($fila);
                        $camion = $this->camion->camion_por_clave($fila['C'], get_attr_session('usr_cuenta_id'));
                        $material_acarreo = $this->material_acarreo->material_acarreo_por_nombre_obra_id($fila['D'], $obras_id, get_attr_session('usr_cuenta_id'));
                        $zona = $this->zona->zonas_por_nombre_obras_id($fila['F'], $obras_id, get_attr_session('usr_cuenta_id'));
                        if (is_null($camion) || is_null($material_acarreo) || is_null($zona)) {
                            $filas_erroneas[$num_fila] = $fila;
                            continue;
                        }
                        $ins_acarreo['folio_vale'] = trim($fila['A']);
                        $ins_acarreo['fecha_acarreo'] = fecha_mysql_de_excel_generado(trim($fila['B']));
                        $ins_acarreo['camiones_id'] = $camion->camiones_id;
                        $ins_acarreo['materiales_acarreos_id'] = $material_acarreo->materiales_acarreos_id;
                        $ins_acarreo['tipo_acarreo'] = trim(strtoupper($fila['E']));
                        $ins_acarreo['zonas_id'] = $zona->zonas_id;
                        $ins_acarreo['obras_id'] = $obras_id;
                        $ins_acarreo['checador'] = trim($fila['G']);
                        $ins_acarreo['cuentas_id'] = get_attr_session('usr_cuenta_id');
                        $buscar_acarreo = $this->acarreo->buscar_acarreo($ins_acarreo);
                        if (!is_null($buscar_acarreo)) {
                            $filas_repetidas[$num_fila] = $fila;
                            continue;
                        }
                        $ins_acarreo['costo_material'] = $this->acarreo->calculo_costo_material_con_dto($camion, $material_acarreo, $ins_acarreo['tipo_acarreo']);
                        $aux_costo_acarreo = $this->acarreo->calculo_costo_acarreo_con_dto($obras_id, $camion, $material_acarreo, $ins_acarreo['tipo_acarreo']);
                        if ($aux_costo_acarreo !== false) {
                            $ins_acarreo['costo_acarreo'] = $aux_costo_acarreo;
                        } else {
                            $filas_erroneas[$num_fila] = $fila;
                            continue;
                        }

                        $aux_costo_suministro = $this->acarreo->calculo_costo_suministro_con_dto($obras_id, $camion, $material_acarreo, $ins_acarreo['tipo_acarreo']);
                        if ($aux_costo_suministro !== false){
                            $ins_acarreo['costo_suministro'] = $aux_costo_suministro;
                        }else{
                            $filas_erroneas[$num_fila] = $fila;
                            continue;
                        }

                        $ins_acarreo['acarreos_archivos_id'] = $archivo_id;
                        if ($this->acarreo->insertar($ins_acarreo) === false) {
                            $filas_erroneas[$num_fila] = $fila;
                            continue;
                        }
                    }
                } else {
                    $msg = "Error al guardar el archivo";
                    set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                    redirect('acarreos/carga_archcivo');
                }
                if (count($filas_repetidas) > 0) {
                    $repetidos = array();
                    foreach ($filas_repetidas as $key => $value) {
                        $repetidos[] = "La fila #$key ya había sido cargada con los valores: " . implode(' | ', $value);
                    }
                    set_bootstrap_alert($repetidos, BOOTSTRAP_ALERT_WARNING);
                }
                if (count($filas_erroneas) > 0) {
                    $errores = array();
                    foreach ($filas_erroneas as $key => $value) {
                        $errores[] = "Error en la fila #$key con los valores: " . implode(' | ', $value);
                    }
                    set_bootstrap_alert($errores, BOOTSTRAP_ALERT_WARNING);
                    redirect('acarreos/carga_archcivo');
                }
                $msg = "Se guardó el archivo con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('acarreos');
            }
        }
        redirect('acarreos');
    }

    public function ver_archivo_acarreo($archivo_id = 0)
    {
        if (!valid_id($archivo_id)) {
            redirect('acarreos');
        }
        $archivo = $this->acarreo->ver_archivo_acarreo($archivo_id, get_attr_session('usr_cuenta_id'));
        if (!is_null($archivo)) {
            $this->load->helper('download');
            force_download(RUTA_DOCS_USR . 'acarreos/' . $archivo->nombre_archivo, null, true);
        } else {
            redirect('acarreos');
        }
    }
}