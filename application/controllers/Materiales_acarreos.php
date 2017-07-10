<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Materiales_acarreos extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Material_acarreo');
        $this->load->library('business/Material_servicio');
        $this->load->library('business/Catalogo');
        $this->load->library('business/Obra');
        $this->load->library('business/Proveedor');
    }

    public function index()
    {
        $data['materiales_acarreos'] = $this->material_acarreo->materiales_acarreos_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('materiales_acarreos/materiales_acarreos_index', $data);
    }

    public function insertar()
    {
        $data['materiales'] = $this->material_servicio->materiales_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['unidades'] = $this->catalogo->unidades_todo();
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('materiales_acarreos/materiales_acarreos_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        $this->form_validation->set_rules('proveedores_id', 'Proveedor', 'required|integer');
        $this->form_validation->set_rules('materiales_servicios_id', 'Material', 'required|integer');
        $this->form_validation->set_rules('cat_unidades_id', 'Unidades', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $material_acarreo = $this->input->post();
            if ($this->material_acarreo->insertar($material_acarreo)) {
                $msg = "El material para acarreo se guardó con éxito, inserte otro o <strong><a href='" . base_url('materiales_acarreos') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
            } else {
                $msg = "Error al guardar el material para acarreo, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('materiales_acarreos/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('materiales_acarreos');
        }
        $data['materiales'] = $this->material_servicio->materiales_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['unidades'] = $this->catalogo->unidades_todo();
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['proveedores'] = $this->proveedor->proveedores_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['material_acarreo'] = $this->material_acarreo->material_acarreo_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $this->load->view('materiales_acarreos/materiales_acarreos_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('materiales_acarreos_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('obras_id', 'Obra', 'required|integer');
        $this->form_validation->set_rules('proveedores_id', 'Proveedor', 'required|integer');
        $this->form_validation->set_rules('materiales_servicios_id', 'Material', 'required|integer');
        $this->form_validation->set_rules('cat_unidades_id', 'Unidades', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('materiales_acarreos_id')));
        } else {
            $material_acarreo = $this->input->post();
            if ($this->material_acarreo->editar($material_acarreo)){
                $msg = "La material_acarreo se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('materiales_acarreos');
            }else{
                $msg = "Error al guardar el material_acarreo.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('materiales_acarreos/' . $material_acarreo['materiales_acarreos_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('materiales_acarreos');
        }
        if ($this->material_acarreo->borrado_final(array('materiales_acarreos_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('materiales_acarreos');
    }
}