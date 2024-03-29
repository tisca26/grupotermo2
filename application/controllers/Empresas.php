<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Empresas extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index', 'municipios_por_estado'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Empresa');
        $this->load->library('business/Cat_ubicacion');
    }

    public function municipios_por_estado($estados_id = 0)
    {
        $municipios = array();
        if (valid_id($estados_id)) {
            $municipios = $this->cat_ubicacion->municipio_por_estado($estados_id);
        }
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($municipios);
    }

    public function index()
    {
        $data['empresas'] = $this->empresa->empresas_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('empresas/empresas_index', $data);
    }

    public function insertar()
    {
        $data['estados'] = $this->cat_ubicacion->estados_mxn();
        $this->load->view('empresas/empresas_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        $this->form_validation->set_rules('rfc', 'RFC', 'required|max_length[15]');
        $this->form_validation->set_rules('cat_municipios_id', 'Municipio', 'required|integer');
        $this->form_validation->set_rules('cat_estados_id', 'Estado', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $empresa = $this->input->post();
            $empresa['estatus'] = isset($empresa['estatus']) ? 1 : 0;
            if ($this->empresa->insertar($empresa)) {
                $msg = "La empresa se guardó con éxito, inserte otro o <strong><a href='" . base_url('empresas') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            } else {
                $msg = "Error al guardar la empresa, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('empresas/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('empresas');
        }
        $data['empresa'] = $this->empresa->empresa_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $data['estados'] = $this->cat_ubicacion->estados_mxn();
        $data['municipios'] = $this->cat_ubicacion->municipio_por_estado($data['empresa']->cat_estados_id);
        $this->load->view('empresas/empresas_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('empresas_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        $this->form_validation->set_rules('rfc', 'RFC', 'required|max_length[15]');
        $this->form_validation->set_rules('cat_municipios_id', 'Municipio', 'required|integer');
        $this->form_validation->set_rules('cat_estados_id', 'Estado', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('empresas_id')));
        } else {
            $empresa = $this->input->post();
            $empresa['estatus'] = isset($empresa['estatus']) ? 1 : 0;
            if ($this->empresa->editar($empresa)){
                $msg = "La empresa se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('empresas');
            }else{
                $msg = "Error al guardar la empresa.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('empresas/' . $empresa['empresas_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('empresas');
        }
        if ($this->empresa->borrado_final(array('empresas_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('empresas');
    }
}