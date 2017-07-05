<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_ubicacion_model extends CI_Model
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

    public function paises_todos($order_by = 'cat_paises_id')
    {
        $res = array();
        $q = $this->db->order_by($order_by)->get('cat_paises');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function estados_por_pais($paises_id = 0, $order_by = 'cat_estados_id')
    {
        $res = array();
        $q = $this->db->where('cat_paises_id', $paises_id)->order_by($order_by)->get('cat_estados');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function municipios_por_estado($estados_id = 0, $order_by = 'cat_municipios_id')
    {
        $res = array();
        $q = $this->db->where('cat_estados_id', $estados_id)->order_by($order_by)->get('cat_municipios');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }
}