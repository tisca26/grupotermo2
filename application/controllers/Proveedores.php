<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Proveedores extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index', 'municipios_por_estado'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Proveedor');
        $this->load->library('business/Cat_ubicacion');
        $this->load->library('business/Catalogo');
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
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('proveedores/proveedores_index', $data);
    }

    public function insertar()
    {
        $data['estados'] = $this->cat_ubicacion->estados_mxn();
        $data['bancos'] = $this->catalogo->bancos_todos();
        $this->load->view('proveedores/proveedores_insertar', $data);
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
            $proveedor = $this->input->post();
            $proveedor['estatus'] = isset($proveedor['estatus']) ? 1 : 0;
            if ($this->proveedor->insertar($proveedor)) {
                $msg = "La proveedor se guardó con éxito, inserte otro o <strong><a href='" . base_url('proveedores') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            } else {
                $msg = "Error al guardar la proveedor, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('proveedores/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('proveedores');
        }
        $data['proveedor'] = $this->proveedor->proveedor_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $data['estados'] = $this->cat_ubicacion->estados_mxn();
        $data['municipios'] = $this->cat_ubicacion->municipio_por_estado($data['proveedor']->cat_estados_id);
        $data['bancos'] = $this->catalogo->bancos_todos();
        $this->load->view('proveedores/proveedores_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('proveedores_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        $this->form_validation->set_rules('rfc', 'RFC', 'required|max_length[15]');
        $this->form_validation->set_rules('cat_municipios_id', 'Municipio', 'required|integer');
        $this->form_validation->set_rules('cat_estados_id', 'Estado', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('proveedores_id')));
        } else {
            $proveedor = $this->input->post();
            $proveedor['estatus'] = isset($proveedor['estatus']) ? 1 : 0;
            if ($this->proveedor->editar($proveedor)){
                $msg = "La proveedor se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('proveedores');
            }else{
                $msg = "Error al guardar la proveedor.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('proveedores/' . $proveedor['proveedores_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('proveedores');
        }
        if ($this->proveedor->borrado_final(array('proveedores_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('proveedores');
    }
}