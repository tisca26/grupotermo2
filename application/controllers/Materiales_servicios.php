<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Materiales_servicios extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Material_servicio');
    }

    public function index()
    {
        $data['materiales_servicios'] = $this->material_servicio->materiales_servicios_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('materiales_servicios/materiales_servicios_index', $data);
    }

    public function insertar()
    {
        $this->load->view('materiales_servicios/materiales_servicios_insertar');
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $material = $this->input->post();
            if ($this->material_servicio->insertar($material)) {
                $msg = "El material se guardó con éxito, inserte otro o <strong><a href='" . base_url('materiales_servicios') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            } else {
                $msg = "Error al guardar el material, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('materiales_servicios/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('materiales_servicios');
        }
        $data['material'] = $this->material_servicio->material_servicio_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $this->load->view('materiales_servicios/materiales_servicios_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('materiales_servicios_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('materiales_servicios_id')));
        } else {
            $material = $this->input->post();
            if ($this->material_servicio->editar($material)){
                $msg = "La material se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('materiales_servicios');
            }else{
                $msg = "Error al guardar la material.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('materiales_servicios/' . $material['materiales_servicios_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('materiales_servicios');
        }
        if ($this->material_servicio->borrado_final(array('materiales_servicios_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('materiales_servicios');
    }
}