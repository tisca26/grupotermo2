<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Materiales_model extends CI_Model
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

    public function materiales_todos_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'materiales_id')
    {
        $res = array();
        if (!is_null($estatus)){
            $this->db->where('estatus', $estatus);
        }
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('materiales');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('materiales', $data);
    }

    public function material_por_id_y_cuenta($materiales_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('materiales_id', $materiales_id)->get('materiales');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($material = array())
    {
        return $this->db->update('materiales', $material, array('materiales_id' => $material['materiales_id']));
    }

    public function borrar($material = array())
    {
        return $this->db->delete('materiales', $material);
    }
}