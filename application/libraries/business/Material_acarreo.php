<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Material_acarreo
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('materiales_acarreos_model');
    }

    public function materiales_acarreos_por_cuenta($cuentas_id = 0, $order_by = 'materiales_acarreos_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->materiales_acarreos_model->materiales_acarreos_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function material_acarreo_por_id_y_cuenta($materiales_acarreos_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->materiales_acarreos_model->material_acarreo_por_id_y_cuenta($materiales_acarreos_id, $cuentas_id);
    }

    public function insertar($material_acarreo = array())
    {
        $material_acarreo['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->materiales_acarreos_model->insertar($material_acarreo);
    }

    public function editar($material_acarreo = array())
    {
        return $this->CI->materiales_acarreos_model->editar($material_acarreo);
    }

    public function borrado_final($material_acarreo  = array())
    {
        return $this->CI->materiales_acarreos_model->borrar($material_acarreo);
    }
}