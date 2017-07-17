<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifa_suministro
{
    protected $CI;
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('tarifas_suministros_model');
    }

    public function tarifas_suministros_por_cuenta($cuentas_id = 0, $order_by = 'tarifas_suministros_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->tarifas_suministros_model->tarifas_suministros_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function tarifa_suministro_por_id_y_cuenta($tarifas_suministros_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->tarifas_suministros_model->tarifa_suministro_por_id_y_cuenta($tarifas_suministros_id, $cuentas_id);
    }

    public function insertar($tarifa_suministro = array())
    {
        $tarifa_suministro['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->tarifas_suministros_model->insertar($tarifa_suministro);
    }

    public function editar($tarifa_suministro = array())
    {
        return $this->CI->tarifas_suministros_model->editar($tarifa_suministro);
    }

    public function borrado_final($tarifa_suministro  = array())
    {
        return $this->CI->tarifas_suministros_model->borrar($tarifa_suministro);
    }

    public function tarifas_por_obras_id($cuentas_id = 0, $obras_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->tarifas_suministros_model->tarifas_por_obras_id($cuentas_id, $obras_id);
    }

    public function tarifas_por_obra_proveedor($obras_id = 0, $proveedores_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->tarifas_suministros_model->tarifas_por_obra_proveedor($obras_id, $proveedores_id, $cuentas_id);
    }

    public function tarifa_por_material_obra_proveedor($cuentas_id = 0, $material_id = 0, $obras_id = 0, $proveedor_id = 0){
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->tarifas_suministros_model->tarifa_por_material_obra_proveedor($cuentas_id, $material_id, $obras_id, $proveedor_id);
    }
}