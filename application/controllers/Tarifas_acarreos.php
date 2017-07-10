<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Tarifas_acarreos extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Tarifa_acarreo');
        $this->load->library('business/Obra');
        $this->load->library('business/Proveedor');
    }

    public function index()
    {
        $data['tarifas_acarreos'] = $this->tarifa_acarreo->tarifas_acarreos_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('tarifas_acarreos/tarifas_acarreos_index', $data);
    }

    public function insertar()
    {
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('tarifas_acarreos/tarifas_acarreos_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        $this->form_validation->set_rules('proveedores_id', 'Proveedor', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $tarifa_acarreo = $this->input->post();
            if ($this->tarifa_acarreo->insertar($tarifa_acarreo)) {
                $msg = "La tarifa para acarreo se guardó con éxito, inserte otro o <strong><a href='" . base_url('tarifas_acarreos') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            } else {
                $msg = "Error al guardar la tarifa para acarreo, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('tarifas_acarreos/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('tarifas_acarreos');
        }
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['tarifa_acarreo'] = $this->tarifa_acarreo->tarifa_acarreo_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $this->load->view('tarifas_acarreos/tarifas_acarreos_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('tarifas_acarreos_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        $this->form_validation->set_rules('proveedores_id', 'Proveedor', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('tarifas_acarreos_id')));
        } else {
            $tarifa_acarreo = $this->input->post();
            if ($this->tarifa_acarreo->editar($tarifa_acarreo)){
                $msg = "La tarifa de acarreo se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('tarifas_acarreos');
            }else{
                $msg = "Error al guardar el tarifa de acarreo.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('tarifas_acarreos/' . $tarifa_acarreo['tarifas_acarreos_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('tarifas_acarreos');
        }
        if ($this->tarifa_acarreo->borrado_final(array('tarifas_acarreos_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('tarifas_acarreos');
    }
}