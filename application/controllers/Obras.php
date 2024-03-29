<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Obras extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index', 'municipios_por_estado', 'ver_archivo'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Obra');
        $this->load->library('business/Cliente');
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
        $data['obras'] = $this->obra->obras_por_cuenta(get_attr_session('usr_cuenta_id'));
        $this->load->view('obras/obras_index', $data);
    }

    public function insertar()
    {
        $data['empresas'] = $this->empresa->empresas_por_cuenta(get_attr_session('usr_cuenta_id'), 1);
        $data['clientes'] = $this->cliente->clientes_por_cuenta(get_attr_session('usr_cuenta_id'), 1);
        $data['estados'] = $this->cat_ubicacion->estados_mxn();
        $this->load->view('obras/obras_insertar', $data);
    }

    public function frm_insertar()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha inicio', 'required');
        $this->form_validation->set_rules('cat_municipios_id', 'Municipio', 'required|integer');
        $this->form_validation->set_rules('cat_estados_id', 'Estado', 'required|integer');
        $this->form_validation->set_rules('empresas_id', 'Empresa', 'required|integer');
        $this->form_validation->set_rules('clientes_id', 'Cliente', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->insertar();
        } else {
            $obra = $this->input->post();
            $obra['estatus'] = isset($obra['estatus']) ? 1 : 0;
            if ($this->obra->insertar($obra)) {
                $msg = "La obra se guardó con éxito, inserte otro o <strong><a href='" . base_url('obras') . "'>vuela al inicio</a></strong>";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                if ($_FILES AND $_FILES['obras_file']['name']) {
                    $this->load->library('upload');
                    $nombre_archivo = 'obras_id_' . $this->obra->ultimo_id() . '_' . get_attr_session('usr_username') . '_' . date('Y-m-d_H_i_s');
                    $config['upload_path'] = RUTA_DOCS_USR . 'obras/';
                    $config['allowed_types'] = 'pdf';
                    $config['file_name'] = $nombre_archivo;
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('obras_file')) {
                        $msg = $this->upload->display_errors();
                        set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                        redirect('obras/editar/' . $this->obra->ultimo_id());
                    } else {
                        $atributos_archivo = $this->upload->data();
                        $guarda_info_carga['nombre'] = $atributos_archivo['file_name'];
                        $guarda_info_carga['obras_id'] = $this->obra->ultimo_id();
                        if (!$this->obra->insertar_archivo($guarda_info_carga)) {
                            $msg = 'Error al guardar el archivo';
                            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                            redirect('obras/editar/' . $this->obra->ultimo_id());
                        }
                    }
                }
            } else {
                $msg = "Error al guardar la obra, intente nuevamente";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            }
            redirect('obras/insertar');
        }
    }

    public function editar($id = 0)
    {
        if (!valid_id($id)) {
            $msg = 'Error en el identificador';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('obras');
        }
        $data['obra'] = $this->obra->obra_por_id_y_cuenta($id, get_attr_session('usr_cuenta_id'));
        $data['empresas'] = $this->empresa->empresas_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['clientes'] = $this->cliente->clientes_por_cuenta(get_attr_session('usr_cuenta_id'));
        $data['estados'] = $this->cat_ubicacion->estados_mxn();
        $data['municipios'] = $this->cat_ubicacion->municipio_por_estado($data['obra']->cat_estados_id);
        $this->load->view('obras/obras_editar', $data);
    }

    public function frm_editar()
    {
        $this->form_validation->set_rules('obras_id', 'Identificador', 'required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[254]');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha inicio', 'required');
        $this->form_validation->set_rules('cat_municipios_id', 'Municipio', 'required|integer');
        $this->form_validation->set_rules('cat_estados_id', 'Estado', 'required|integer');
        $this->form_validation->set_rules('empresas_id', 'Empresa', 'required|integer');
        $this->form_validation->set_rules('clientes_id', 'Cliente', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->editar($this->input->post('obras_id')));
        } else {
            $obra = $this->input->post();
            $obra['estatus'] = isset($obra['estatus']) ? 1 : 0;
            if ($this->obra->editar($obra)) {
                $msg = "La obra se guardó con éxito";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                if ($_FILES AND $_FILES['obras_file']['name']) {
                    $this->load->library('upload');
                    $nombre_archivo = 'obras_id_' . $obra['obras_id'] . '_' . get_attr_session('usr_username') . '_' . date('Y-m-d_H_i_s');
                    $config['upload_path'] = RUTA_DOCS_USR . 'obras/';
                    $config['allowed_types'] = 'pdf';
                    $config['file_name'] = $nombre_archivo;
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('obras_file')) {
                        $msg = $this->upload->display_errors();
                        set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                        redirect('obras/editar/' . $obra['obras_id']);
                    } else {
                        $atributos_archivo = $this->upload->data();
                        $guarda_info_carga['nombre'] = $atributos_archivo['file_name'];
                        $guarda_info_carga['obras_id'] = $obra['obras_id'];
                        if (!$this->obra->insertar_archivo($guarda_info_carga)) {
                            $msg = 'Error al guardar el archivo';
                            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
                            redirect('obras/editar/' . $obra['obras_id']);
                        }
                    }
                }
                redirect('obras');
            } else {
                $msg = "Error al guardar la obra.";
                set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
                redirect('obras/' . $obra['obras_id']);
            }
        }
    }

    public function borrar($id = 0)
    {
        if (!valid_id($id)) {
            return redirect('obras');
        }
        if ($this->obra->borrado_final(array('obras_id' => $id))) {
            $msg = 'Se borró el registro con éxito';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);
        } else {
            $msg = 'Error al borrar el registro, intente nuevamente';
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
        }
        redirect('obras');
    }

    public function ver_archivo($archivo_id = 0)
    {
        if (!valid_id($archivo_id)) {
            redirect('obras');
        }
        $archivo = $this->obra->obras_archivo_por_id($archivo_id);
        if (!is_null($archivo)) {
            if ($this->obra->es_archivo_de_cuenta($archivo, get_attr_session('usr_cuenta_id'))) {
                $this->load->helper('download');
                force_download(RUTA_DOCS_USR . 'obras/' . $archivo->nombre, null, true);
            } else {
                redirect('mensajes_sys/denegado');
            }
        } else {
            redirect('obras');
        }
    }
}