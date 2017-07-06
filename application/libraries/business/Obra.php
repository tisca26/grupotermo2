<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Obra
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('obras_model');
    }

    public function ultimo_id()
    {
        return $this->CI->obras_model->ultimo_id();
    }

    public function obra_por_id_simple($id = 0)
    {
        return $this->CI->obras_model->obra_por_id_simple($id);
    }

    public function obras_por_cuenta($cuentas_id = 0, $order_by = 'obras_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->obras_model->obras_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function obra_por_id_y_cuenta($obras_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        $obra = $this->CI->obras_model->obra_por_id_y_cuenta($obras_id, $cuentas_id);
        if (!is_null($obra)) {
            $obra->archivos = $this->archivos_por_obra_id($obras_id);
        }
        return $obra;
    }

    public function archivos_por_obra_id($obra_id = 0)
    {
        return $this->CI->obras_model->archivos_por_obra_id($obra_id);
    }

    public function obras_archivo_por_id($archivo_id = 0)
    {
        return $this->CI->obras_model->obras_archivo_por_id($archivo_id);
    }

    public function es_archivo_de_cuenta($archivo = null, $cuentas_id = 0)
    {
        $res = false;
        if (!is_null($archivo)) {
            $obra = $this->obra_por_id_simple($archivo->obras_id);
            if (!is_null($obra)) {
                if ($cuentas_id === $obra->cuentas_id){
                    return true;
                }
            }
        }
        return $res;
    }

    public function insertar($obra = array())
    {
        $obra['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->obras_model->insertar($obra);
    }

    public function editar($obra = array())
    {
        return $this->CI->obras_model->editar($obra);
    }

    public function insertar_archivo($data = array())
    {
        $data['fecha_creacion'] = date('Y-m-d H:i:s');
        return $this->CI->obras_model->insertar_archivo($data);

    }

    public function borrado_final($obra = array())
    {
        return $this->CI->obras_model->borrar($obra);
    }
}