<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model
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

    public function clientes_todos_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'clientes_id')
    {
        $res = array();
        if (!is_null($estatus)){
            $this->db->where('estatus', $estatus);
        }
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('clientes');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('clientes', $data);
    }

    public function cliente_por_id_y_cuenta($clientes_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('clientes_id', $clientes_id)->get('clientes');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($cliente = array())
    {
        return $this->db->update('clientes', $cliente, array('clientes_id' => $cliente['clientes_id']));
    }

    public function borrar($cliente = array())
    {
        return $this->db->delete('clientes', $cliente);
    }
}