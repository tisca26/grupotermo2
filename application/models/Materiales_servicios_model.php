<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Materiales_servicios_model extends CI_Model
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

    public function materiales_todos_por_cuenta($cuentas_id = 0, $order_by = 'materiales_servicios_id')
    {
        $res = array();
        $q = $this->db->where('tipo', 1)->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('materiales_servicios');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function servicios_todos_por_cuenta($cuentas_id = 0, $order_by = 'materiales_servicios_id')
    {
        $res = array();
        $q = $this->db->where('tipo', 0)->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('materiales_servicios');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function materiales_servicios_todos_por_cuenta($cuentas_id = 0, $order_by = 'materiales_servicios_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('materiales_servicios');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('materiales_servicios', $data);
    }

    public function material_servicio_por_id_y_cuenta($materiales_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('materiales_servicios_id', $materiales_id)->get('materiales_servicios');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($material = array())
    {
        return $this->db->update('materiales_servicios', $material, array('materiales_servicios_id' => $material['materiales_servicios_id']));
    }

    public function borrar($material = array())
    {
        return $this->db->delete('materiales_servicios', $material);
    }
}