<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Tarifas_suministros extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index', 'materiales_acarreo_por_obra'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Tarifa_suministro');
        $this->load->library('business/Material_acarreo');
        $this->load->library('business/Obra');
        $this->load->library('business/Proveedor');
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
        $data['tarifas_suministros'] = $this->tarifa_suministro->tarifas_suministros_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('tarifas_suministros/tarifas_suministros_index', $data);
    }

    public function insertar()
    {
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('tarifas_suministros/tarifas_suministros_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $obras_id = $this->input->post('obras_id');
            $tarifas_group = $this->input->post('tarifas-group');
            foreach ($tarifas_group as $tarifa) {
                $insert['obras_id'] = $obras_id;
                $insert['proveedores_id'] = $tarifa['proveedores_id'];
                $insert['materiales_acarreos_id'] = $tarifa['materiales_acarreos_id'];
                $insert['costo'] = $tarifa['costo'];
                if ($this->tarifa_suministro->insertar($insert) === false) {
                    $msg = "Error al guardar la tarifa de suministro con costo de $" . $insert['costo'] . ", intente nuevamente";
                    set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                }
            }
            $msg = "La tarifa para acarreo se guardó con éxito, inserte otro o <strong><a href='" . base_url('tarifas_suministros') . "'>vuela al inicio</a></strong>";
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            redirect('tarifas_suministros/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('tarifas_suministros');
        }
        $data['tarifa_suministro'] = $this->tarifa_suministro->tarifa_suministro_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['materiales'] = $this->material_acarreo->materiales_acarreos_por_obras_id(get_attr_session('usr_cuenta_id'), $data['tarifa_suministro']->obras_id);
        $this->load->view('tarifas_suministros/tarifas_suministros_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('tarifas_suministros_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        $this->form_validation->set_rules('proveedores_id', 'Proveedor', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('tarifas_suministros_id')));
        } else {
            $tarifa_suministro = $this->input->post();
            if ($this->tarifa_suministro->editar($tarifa_suministro)){
                $msg = "La tarifa de acarreo se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('tarifas_suministros');
            }else{
                $msg = "Error al guardar el tarifa de acarreo.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('tarifas_suministros/' . $tarifa_suministro['tarifas_suministros_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('tarifas_suministros');
        }
        if ($this->tarifa_suministro->borrado_final(array('tarifas_suministros_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('tarifas_suministros');
    }
}