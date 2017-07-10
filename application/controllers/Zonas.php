<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Zonas extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index', 'municipios_por_estado'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Zona');
        $this->load->library('business/Obra');
    }

    public function index()
    {
        $data['zonas'] = $this->zona->zonas_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('zonas/zonas_index', $data);
    }

    public function insertar()
    {
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('zonas/zonas_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $obras_id = $this->input->post('obras_id');
            $zonas = $this->input->post('zonas-group');
            $error = false;
            foreach ($zonas as $fila){
                $zona['obras_id'] = $obras_id;
                $zona['nombre'] = $fila['nombre'];
                if ($this->zona->insertar($zona) === false){
                    $msg = "Error al guardar la zona, intente nuevamente";
                    set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                    $error = true;
                    break;
                }
            }
            if (!$error){
                $msg = "Las zonas se guardaron con éxito, inserte otro o <strong><a href='" . base_url('zonas') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            }
            redirect('zonas/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('zonas');
        }
        $data['zona'] = $this->zona->zona_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('zonas/zonas_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('zonas_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('zonas_id')));
        } else {
            $zona = $this->input->post();
            if ($this->zona->editar($zona)){
                $msg = "La zona se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('zonas');
            }else{
                $msg = "Error al guardar la zona.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('zonas/' . $zona['zonas_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('zonas');
        }
        if ($this->zona->borrado_final(array('zonas_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('zonas');
    }
}