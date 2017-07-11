<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acarreo
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('acarreos_model');
    }

    public function acarreos_por_cuenta($cuentas_id = 0, $order_by = 'acarreos_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->acarreos_model->acarreos_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function acarreo_por_id_y_cuenta($acarreos_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->acarreos_model->acarreo_por_id_y_cuenta($acarreos_id, $cuentas_id);
    }

    public function insertar($acarreo = array())
    {
        $acarreo['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->acarreos_model->insertar($acarreo);
    }

    public function editar($acarreo = array())
    {
        return $this->CI->acarreos_model->editar($acarreo);
    }

    public function borrado_final($acarreo  = array())
    {
        return $this->CI->acarreos_model->borrar($acarreo);
    }
}