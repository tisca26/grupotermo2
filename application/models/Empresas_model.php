<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ultimo_id()
    {
        return $this->db->insert_id();
    }

    public function error_consulta()
    {
        return $this->db->error();
    }

    public function empresas_todos_por_cuenta($cuentas_id = 0, $order_by = 'empresas_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('empresas');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('empresas', $data);
    }

    public function empresa_por_id_y_cuenta($empresas_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('empresas_id', $empresas_id)->get('empresas');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($empresa = array())
    {
        return $this->db->update('empresas', $empresa, array('empresas_id' => $empresa['empresas_id']));
    }

    public function borrar($empresa = array())
    {
        return $this->db->delete('empresas', $empresa);
    }
}