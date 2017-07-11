<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Materiales_acarreos_model extends CI_Model
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

    public function materiales_acarreos_todos_por_cuenta($cuentas_id = 0, $order_by = 'materiales_acarreos_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('v_materiales_acarreos');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('materiales_acarreos', $data);
    }

    public function material_acarreo_por_id_y_cuenta($materiales_acarreos_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('materiales_acarreos_id', $materiales_acarreos_id)->get('v_materiales_acarreos');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($material_acarreo = array())
    {
        return $this->db->update('materiales_acarreos', $material_acarreo, array('materiales_acarreos_id' => $material_acarreo['materiales_acarreos_id']));
    }

    public function borrar($material_acarreo = array())
    {
        return $this->db->delete('materiales_acarreos', $material_acarreo);
    }

    public function materiales_acarreos_por_obras_id($cuentas_id = 0, $obras_id = 0)
    {
        return $this->db->where('cuentas_id', $cuentas_id)->where('obras_id', $obras_id)->get('materiales_acarreos')->result();
    }
}