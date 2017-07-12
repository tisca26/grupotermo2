<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acarreos_model extends CI_Model
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

    public function acarreos_todos_por_cuenta($cuentas_id = 0, $order_by = 'acarreos_id')
    {
        $res = array();
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('v_acarreos');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function insertar($data = array())
    {
        return $this->db->insert('acarreos', $data);
    }

    public function acarreo_por_id_y_cuenta($acarreos_id = 0, $cuentas_id = 0)
    {
        $obj = null;
        $q = $this->db->where('cuentas_id', $cuentas_id)->where('acarreos_id', $acarreos_id)->get('v_acarreos');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function editar($acarreo = array())
    {
        return $this->db->update('acarreos', $acarreo, array('acarreos_id' => $acarreo['acarreos_id']));
    }

    public function borrar($acarreo = array())
    {
        return $this->db->delete('acarreos', $acarreo);
    }

    public function insertar_acarreos_archivos($data = array())
    {
        return $this->db->insert('acarreos_archivos', $data);
    }

    public function ver_archivo_acarreo($archivo_id = 0, $cuentas_id = 0)
    {
        return $this->db->where('cuentas_id', $cuentas_id)->where('acarreos_archivos_id', $archivo_id)->get('acarreos_archivos')->row();
    }

    public function buscar_acarreo($data = array())
    {
        return $this->db->where($data)->get('acarreos')->row();
    }
}