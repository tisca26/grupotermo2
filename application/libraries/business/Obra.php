<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Obra
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('obras_model');
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
        return $this->CI->obras_model->obra_por_id_y_cuenta($obras_id, $cuentas_id);
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

    public function borrado_final($obra  = array())
    {
        return $this->CI->obras_model->borrar($obra);
    }
}