<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Camiones extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Camion');
        $this->load->library('business/Proveedor');
    }

    public function index()
    {
        $data['camiones'] = $this->camion->camiones_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('camiones/camiones_index', $data);
    }

    public function insertar()
    {
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('camiones/camiones_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('placa', 'Placa', 'required|min_length[3]|max_length[10]');
        $this->form_validation->set_rules('proveedores_id', 'Proveedor', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $camion = $this->input->post();
            if ($this->camion->insertar($camion)) {
                $msg = "El camion se guardó con éxito, inserte otro o <strong><a href='" . base_url('camiones') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            } else {
                $msg = "Error al guardar el camion, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('camiones/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('camiones');
        }
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['camion'] = $this->camion->camion_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $this->load->view('camiones/camiones_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('camiones_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('placa', 'Placa', 'required|min_length[3]|max_length[10]');
        $this->form_validation->set_rules('proveedores_id', 'Proveedor', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('camiones_id')));
        } else {
            $camion = $this->input->post();
            if ($this->camion->editar($camion)){
                $msg = "El camion se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('camiones');
            }else{
                $msg = "Error al guardar el camion.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('camiones/' . $camion['camiones_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('camiones');
        }
        if ($this->camion->borrado_final(array('camiones_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('camiones');
    }
}