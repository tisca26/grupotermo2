<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Obras_model extends CI_Model
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

    public function obras_todos_por_cuenta($cuentas_id = 0, $order_by = 'obras_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('v_obras');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('obras', $data);
    }

    public function obra_por_id_y_cuenta($obras_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('obras_id', $obras_id)->get('v_obras');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($obra = array())
    {
        return $this->db->update('obras', $obra, array('obras_id' => $obra['obras_id']));
    }

    public function borrar($obra = array())
    {
        return $this->db->delete('obras', $obra);
    }

    public function insertar_archivo($data = array())
    {
        return $this->db->insert('obras_archivos', $data);
    }

    public function archivos_por_obra_id($obras_id = 0)
    {
        return $this->db->where('obras_id', $obras_id)->get('obras_archivos')->result();
    }

    public function obras_archivo_por_id($archivo_id = 0)
    {
        return $this->db->where('obras_archivos_id', $archivo_id)->get('obras_archivos')->row();
    }

    public function obra_por_id_simple($id = 0)
    {
        return $this->db->where('obras_id', $id)->get('obras')->row();
    }
}