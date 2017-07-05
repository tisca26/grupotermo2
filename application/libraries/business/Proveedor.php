<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Proveedor
{
    protected $CI;
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('proveedores_model');
    }

    public function proveedores_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'proveedores_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->proveedores_model->proveedores_todos_por_cuenta($cuentas_id, $estatus, $order_by);
    }

    public function proveedor_por_id_y_cuenta($proveedores_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->proveedores_model->proveedor_por_id_y_cuenta($proveedores_id, $cuentas_id);
    }

    public function insertar($proveedor = array())
    {
        $proveedor['cuentas_id'] = get_attr_session('usr_cuenta_id');
        $proveedor['rfc'] = strtoupper($proveedor['rfc']);
        return $this->CI->proveedores_model->insertar($proveedor);
    }

    public function editar($proveedor = array())
    {
        $proveedor['rfc'] = strtoupper($proveedor['rfc']);
        return $this->CI->proveedores_model->editar($proveedor);
    }

    public function borrado_final($proveedor  = array())
    {
        return $this->CI->proveedores_model->borrar($proveedor);
    }
}