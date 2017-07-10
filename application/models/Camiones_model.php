<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Camiones_model extends CI_Model
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

    public function camiones_todos_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'camiones_id')
    {
        $res = array();
        if (!is_null($estatus)){
            $this->db->where('estatus', $estatus);
        }
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('v_camiones');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('camiones', $data);
    }

    public function camion_por_id_y_cuenta($camiones_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('camiones_id', $camiones_id)->get('v_camiones');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($camion = array())
    {
        return $this->db->update('camiones', $camion, array('camiones_id' => $camion['camiones_id']));
    }

    public function borrar($camion = array())
    {
        return $this->db->delete('camiones', $camion);
    }
}