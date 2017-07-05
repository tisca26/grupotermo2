<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('catalogos_model');
    }

    public function bancos_todos($order_by = 'cat_bancos_id')
    {
        return $this->CI->catalogos_model->bancos_todos($order_by);
    }
}