<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('clientes_model');
    }

    public function clientes_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'clientes_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->clientes_model->clientes_todos_por_cuenta($cuentas_id, $estatus, $order_by);
    }

    public function cliente_por_id_y_cuenta($clientes_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->clientes_model->cliente_por_id_y_cuenta($clientes_id, $cuentas_id);
    }

    public function insertar($cliente = array())
    {
        $cliente['cuentas_id'] = get_attr_session('usr_cuenta_id');
        $cliente['rfc'] = strtoupper($cliente['rfc']);
        return $this->CI->clientes_model->insertar($cliente);
    }

    public function editar($cliente = array())
    {
        $cliente['rfc'] = strtoupper($cliente['rfc']);
        return $this->CI->clientes_model->editar($cliente);
    }

    public function borrado_final($cliente = array())
    {
        return $this->CI->clientes_model->borrar($cliente);
    }
}