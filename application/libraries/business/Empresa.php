<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('empresas_model');
    }

    public function empresas_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'empresas_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->empresas_model->empresas_todos_por_cuenta($cuentas_id, $estatus, $order_by);
    }

    public function empresa_por_id_y_cuenta($empresas_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->empresas_model->empresa_por_id_y_cuenta($empresas_id, $cuentas_id);
    }

    public function insertar($empresa = array())
    {
        $empresa['cuentas_id'] = get_attr_session('usr_cuenta_id');
        $empresa['rfc'] = strtoupper($empresa['rfc']);
        return $this->CI->empresas_model->insertar($empresa);
    }

    public function editar($empresa = array())
    {
        $empresa['rfc'] = strtoupper($empresa['rfc']);
        return $this->CI->empresas_model->editar($empresa);
    }

    public function borrado_final($empresa  = array())
    {
        return $this->CI->empresas_model->borrar($empresa);
    }

}