<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Ejemplo_carga extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('Lector_archivos');
        $this->load->model('ejemplo_carga_model');
        $this->load->model('archivos_cargados_model');
    }

    public function index()
    {
        $this->load->view('ejemplo_carga/ejemplo_carga_index');
    }

    public function frm_insertar()
    {
        $this->load->library('upload');
        $nombre_archivo = get_attr_session('usr_username') . '_' . date('Y-m-d_H_i_s');
        $config['upload_path'] = RUTA_DOCS_USR;
        $config['allowed_types'] = 'xls|xlsx';
        $config['file_name'] = $nombre_archivo;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('input_file')) {
            $msg = $this->upload->display_errors();
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_DANGER);
            redirect('ejemplo_carga');
        } else {
            $atributos_archivo = $this->upload->data();
            $msg = 'El archivo se subió con éxito: ' . get_attr_session('usr_username') . '_' . date('Y-m-d_H:i:s');
            set_bootstrap_alert($msg, BOOTSTRAP_ALERT_SUCCESS);

            //Trabajamos el archivo
            $guarda_info_carga['nombre_archivo'] = $atributos_archivo['file_name'];
            $guarda_info_carga['usuarios_id'] = get_attr_session('usr_id');
            $guarda_info_carga['fecha_carga'] = date('Y-m-d H:i:s');
            $this->archivos_cargados_model->insertar($guarda_info_carga);
            $id_archivo_cargado = $this->archivos_cargados_model->ultimo_id();
            $hoja = $this->lector_archivos->leer_xlsx(RUTA_DOCS_USR . $atributos_archivo['file_name']);
            foreach ($hoja as $fila){
                //Solo para evitar carga de celdas vacias por error
                if ($fila['A'] == ''){
                    continue;
                }
                $insert['col_1'] = $fila['A'];
                $insert['col_2'] = $fila['B'];
                $insert['col_3'] = $fila['C'];
                $insert['archivos_cargados_id'] = $id_archivo_cargado;
                $this->ejemplo_carga_model->insertar($insert);
            }

            $data['hoja'] = $hoja;
            $this->load->view('ejemplo_carga/ejemplo_carga_index', $data);
        }
    }
}