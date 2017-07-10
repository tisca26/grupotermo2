<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Camion
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('camiones_model');
    }

    public function camiones_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'camiones_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->camiones_model->camiones_todos_por_cuenta($cuentas_id, $estatus, $order_by);
    }

    public function camion_por_id_y_cuenta($camiones_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->camiones_model->camion_por_id_y_cuenta($camiones_id, $cuentas_id);
    }

    public function insertar($camion = array())
    {
        $camion['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->camiones_model->insertar($camion);
    }

    public function editar($camion = array())
    {
        return $this->CI->camiones_model->editar($camion);
    }

    public function borrado_final($camion  = array())
    {
        return $this->CI->camiones_model->borrar($camion);
    }
}