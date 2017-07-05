<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_model extends CI_Model
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

    public function proveedores_todos_por_cuenta($cuentas_id = 0, $order_by = 'proveedores_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('proveedores');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('proveedores', $data);
    }

    public function proveedor_por_id_y_cuenta($proveedores_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('proveedores_id', $proveedores_id)->get('proveedores');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($proveedor = array())
    {
        return $this->db->update('proveedores', $proveedor, array('proveedores_id' => $proveedor['proveedores_id']));
    }

    public function borrar($proveedor = array())
    {
        return $this->db->delete('proveedores', $proveedor);
    }
}