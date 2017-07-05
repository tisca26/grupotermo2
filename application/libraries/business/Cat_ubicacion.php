<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Cat_ubicacion
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('cat_ubicacion_model');
    }

    public function estados_mxn($order_by = 'cat_estados_id'){
        // MXN es 143
        return $this->CI->cat_ubicacion_model->estados_por_pais(143, $order_by);
    }

    public function municipio_por_estado($estados_id = 0, $order_by = 'cat_municipios_id')
    {
        return $this->CI->cat_ubicacion_model->municipios_por_estado($estados_id, $order_by);
    }
}