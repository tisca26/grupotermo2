<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifa_acarreo
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('tarifas_acarreos_model');
    }

    public function tarifas_acarreos_por_cuenta($cuentas_id = 0, $order_by = 'tarifas_acarreos_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->tarifas_acarreos_model->tarifas_acarreos_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function tarifa_acarreo_por_id_y_cuenta($tarifas_acarreos_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->tarifas_acarreos_model->tarifa_acarreo_por_id_y_cuenta($tarifas_acarreos_id, $cuentas_id);
    }

    public function insertar($tarifa_acarreo = array())
    {
        $tarifa_acarreo['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->tarifas_acarreos_model->insertar($tarifa_acarreo);
    }

    public function editar($tarifa_acarreo = array())
    {
        return $this->CI->tarifas_acarreos_model->editar($tarifa_acarreo);
    }

    public function borrado_final($tarifa_acarreo  = array())
    {
        return $this->CI->tarifas_acarreos_model->borrar($tarifa_acarreo);
    }

    public function tarifas_por_obras_id($cuentas_id = 0, $obras_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->tarifas_acarreos_model->tarifas_por_obras_id($cuentas_id, $obras_id);
    }
}