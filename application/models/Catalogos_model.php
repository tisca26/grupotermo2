<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_model extends CI_Model
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

    public function bancos_todos($order_by = 'cat_bancos_id')
    {
        $res = array();
        $q = $this->db->order_by($order_by)->get('cat_bancos');
        if ($q->num_rows() > 0){
            $res = $q->result();
        }
        return $res;
    }
}