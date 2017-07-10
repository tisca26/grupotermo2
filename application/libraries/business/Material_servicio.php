<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Material_servicio
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('materiales_servicios_model');
    }

    public function materiales_por_cuenta($cuentas_id = 0, $order_by = 'materiales_servicios_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->materiales_servicios_model->materiales_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function servicios_por_cuenta($cuentas_id = 0, $order_by = 'materiales_servicios_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->materiales_servicios_model->servicios_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function materiales_servicios_por_cuenta($cuentas_id = 0, $order_by = 'materiales_servicios_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->materiales_servicios_model->materiales_servicios_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function material_servicio_por_id_y_cuenta($materiales_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->materiales_servicios_model->material_servicio_por_id_y_cuenta($materiales_id, $cuentas_id);
    }

    public function insertar($material = array())
    {
        $material['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->materiales_servicios_model->insertar($material);
    }

    public function editar($material = array())
    {
        return $this->CI->materiales_servicios_model->editar($material);
    }

    public function borrado_final($material  = array())
    {
        return $this->CI->materiales_servicios_model->borrar($material);
    }
}