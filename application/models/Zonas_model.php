<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Zonas_model extends CI_Model
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

    public function zonas_todos_por_cuenta($cuentas_id = 0, $order_by = 'zonas_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('v_zonas');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function zonas_por_obra_id($obras_id = 0, $cuentas_id = 0)
    {
        return $this->db->where('cuentas_id', $cuentas_id)->where('obras_id', $obras_id)->get('v_zonas')->result();
    }

    public function insertar($data = array())
    {
        return $this->db->insert('zonas', $data);
    }

    public function zona_por_id_y_cuenta($zonas_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('zonas_id', $zonas_id)->get('v_zonas');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($zona = array())
    {
        return $this->db->update('zonas', $zona, array('zonas_id' => $zona['zonas_id']));
    }

    public function borrar($zona = array())
    {
        return $this->db->delete('zonas', $zona);
    }
}