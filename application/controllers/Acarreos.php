<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Acarreos extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index', 'zonas_por_obra'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Acarreo');
        $this->load->library('business/Camion');
        $this->load->library('business/Material_acarreo');
        $this->load->library('business/Obra');
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

    public function index()
    {
        $data['acarreos'] = $this->acarreo->acarreos_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('acarreos/acarreos_index', $data);
    }

    public function insertar()
    {
        $data['camiones'] = $this->camion->camiones_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['materiales'] = $this->material_acarreo->materiales_acarreos_por_cuenta(get_attr_session('usr_cuenta_id'));
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
        $data['camiones'] = $this->camion->camiones_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['materiales'] = $this->material_acarreo->materiales_acarreos_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['zonas'] = $this->zona->zonas_por_obra_id($data['acarreo']->obras_id, get_attr_session('usr_cuenta_id'));
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
}