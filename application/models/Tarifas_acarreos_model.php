<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifas_acarreos_model extends CI_Model
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

    public function tarifas_acarreos_todos_por_cuenta($cuentas_id = 0, $order_by = 'tarifas_acarreos_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('v_tarifas_acarreos');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('tarifas_acarreos', $data);
    }

    public function tarifa_acarreo_por_id_y_cuenta($tarifas_acarreos_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('tarifas_acarreos_id', $tarifas_acarreos_id)->get('v_tarifas_acarreos');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($tarifa_acarreo = array())
    {
        return $this->db->update('tarifas_acarreos', $tarifa_acarreo, array('tarifas_acarreos_id' => $tarifa_acarreo['tarifas_acarreos_id']));
    }

    public function borrar($tarifa_acarreo = array())
    {
        return $this->db->delete('tarifas_acarreos', $tarifa_acarreo);
    }
}