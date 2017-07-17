<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifas_suministros_model extends CI_Model
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

    public function tarifas_suministros_todos_por_cuenta($cuentas_id = 0, $order_by = 'tarifas_suministros_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('v_tarifas_suministros');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('tarifas_suministros', $data);
    }

    public function tarifa_suministro_por_id_y_cuenta($tarifas_suministros_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('tarifas_suministros_id', $tarifas_suministros_id)->get('v_tarifas_suministros');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($tarifa_suministro = array())
    {
        return $this->db->update('tarifas_suministros', $tarifa_suministro, array('tarifas_suministros_id' => $tarifa_suministro['tarifas_suministros_id']));
    }

    public function borrar($tarifa_suministro = array())
    {
        return $this->db->delete('tarifas_suministros', $tarifa_suministro);
    }

    public function tarifas_por_obras_id($cuentas_id = 0, $obras_id = 0)
    {
        return $this->db->where('cuentas_id', $cuentas_id)->where('obras_id', $obras_id)->get('tarifas_suministros')->result();
    }

    public function tarifa_por_obra_proveedor($obras_id = 0, $proveedores_id = 0, $cuentas_id = 0)
    {
        return $this->db->where('cuentas_id', $cuentas_id)->where('obras_id', $obras_id)->where('proveedores_id', $proveedores_id)->get('tarifas_suministros')->row();
    }
}