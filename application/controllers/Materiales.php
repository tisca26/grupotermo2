<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Materiales extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index', 'municipios_por_estado'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Material');
        $this->load->library('business/Catalogo');
    }

    public function index()
    {
        $data['materiales'] = $this->material->materiales_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('materiales/materiales_index', $data);
    }

    public function insertar()
    {
        $data['unidades'] = $this->catalogo->unidades_todo();
        $this->load->view('materiales/materiales_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        $this->form_validation->set_rules('cat_unidades_id', 'Municipio', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $material = $this->input->post();
            if ($this->material->insertar($material)) {
                $msg = "El material se guardó con éxito, inserte otro o <strong><a href='" . base_url('materiales') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            } else {
                $msg = "Error al guardar el material, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('materiales/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('materiales');
        }
        $data['material'] = $this->material->material_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $data['unidades'] = $this->catalogo->unidades_todo();
        $this->load->view('materiales/materiales_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('materiales_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        $this->form_validation->set_rules('cat_unidades_id', 'Municipio', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('materiales_id')));
        } else {
            $material = $this->input->post();
            if ($this->material->editar($material)){
                $msg = "La material se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('materiales');
            }else{
                $msg = "Error al guardar la material.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('materiales/' . $material['materiales_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('materiales');
        }
        if ($this->material->borrado_final(array('materiales_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('materiales');
    }
}