<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ejemplo_carga_model extends CI_Model
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

    public function insertar($data = array())
    {
        return $this->db->insert('ejemplo_carga', $data);
    }
}