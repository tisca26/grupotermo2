<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Archivos_cargados_model extends CI_Model
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
        return $this->db->insert('archivos_cargados', $data);
    }
}