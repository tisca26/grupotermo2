<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Zona
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('zonas_model');
    }

    public function zonas_por_obra_id($obras_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->zonas_model->zonas_por_obra_id($obras_id, $cuentas_id);
    }

    public function zonas_por_cuenta($cuentas_id = 0, $order_by = 'zonas_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->zonas_model->zonas_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function zona_por_id_y_cuenta($zonas_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->zonas_model->zona_por_id_y_cuenta($zonas_id, $cuentas_id);
    }

    public function insertar($zona = array())
    {
        $zona['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->zonas_model->insertar($zona);
    }

    public function editar($zona = array())
    {
        return $this->CI->zonas_model->editar($zona);
    }

    public function borrado_final($zona  = array())
    {
        return $this->CI->zonas_model->borrar($zona);
    }

    public function zonas_por_nombre_obras_id($nombre_zona = '', $obras_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->zonas_model->zonas_por_nombre_obras_id($nombre_zona, $obras_id, $cuentas_id);
    }
}