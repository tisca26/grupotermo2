<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acarreo
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('acarreos_model');
        $this->CI->load->library('business/Tarifa_acarreo');
        $this->CI->load->library('business/Tarifa_suministro');
    }

    public function ultimo_id()
    {
        return $this->CI->acarreos_model->ultimo_id();
    }

    public function error_consulta()
    {
        return $this->CI->acarreos_model->error_consulta();
    }

    public function acarreos_por_cuenta($cuentas_id = 0, $order_by = 'acarreos_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->acarreos_model->acarreos_todos_por_cuenta($cuentas_id, $order_by);
    }

    public function acarreo_por_id_y_cuenta($acarreos_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->acarreos_model->acarreo_por_id_y_cuenta($acarreos_id, $cuentas_id);
    }

    public function insertar($acarreo = array())
    {
        $acarreo['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->acarreos_model->insertar($acarreo);
    }

    public function editar($acarreo = array())
    {
        return $this->CI->acarreos_model->editar($acarreo);
    }

    public function borrado_final($acarreo = array())
    {
        return $this->CI->acarreos_model->borrar($acarreo);
    }

    public function insertar_acarreos_archivos($data = array())
    {
        $data['cuentas_id'] = get_attr_session('usr_cuenta_id');
        return $this->CI->acarreos_model->insertar_acarreos_archivos($data);
    }

    public function ver_archivo_acarreo($archivo_id = 0, $cuentas_id = 0)
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->acarreos_model->ver_archivo_acarreo($archivo_id, $cuentas_id);
    }

    public function buscar_acarreo($data = array())
    {
        return $this->CI->acarreos_model->buscar_acarreo($data);
    }

    public function calculo_costo_material_con_dto($camion_dto = null, $material_acarreo_dto = null, $tipo_acarreo = 'EXTERNO')
    {
        $costo = 0;
        if (is_null($camion_dto) || is_null($material_acarreo_dto)) {
            return $costo;
        }
        switch ($tipo_acarreo) {
            case 'EXTERNO':
            case 'INTERNO':
                $costo = round($camion_dto->capacidad * $material_acarreo_dto->costo, 2);
                break;
            case 'SUMINISTRO':
                $costo = 0;
                break;
            default:
                $costo = 0;
        }
        return $costo;
    }

    public function calculo_costo_acarreo_con_dto($obras_id = 0, $camion_dto = null, $material_acarreo_dto = null, $tipo_acarreo = 'EXTERNO')
    {
        $costo = 0;
        if (is_null($camion_dto) || is_null($material_acarreo_dto)) {
            return false;
        }
        if ($tipo_acarreo === 'SUMINISTRO') {
            return $costo;
        }
        $tarifa_dto = $this->CI->tarifa_acarreo->tarifa_por_obra_proveedor($obras_id, $camion_dto->proveedores_id, get_attr_session('usr_cuenta_id'));
        if (is_null($tarifa_dto)) {
            return false;
        }
        switch ($tipo_acarreo) {
            case 'EXTERNO':
                $distancia_a_obra = $material_acarreo_dto->distancia_obra;
                $costo = round($tarifa_dto->primer_kilometro * $camion_dto->capacidad, 2);
                $distancia_a_obra -= 1;
                if ($distancia_a_obra > 0) {
                    $distancia_a_obra = round($distancia_a_obra, 0); //redondeamos hacia arriba
                    $costo += round($tarifa_dto->kilometros_subsecuentes * $camion_dto->capacidad * $distancia_a_obra);
                }
                break;
            case 'INTERNO':
                $costo = round($camion_dto->capacidad * $tarifa_dto->interno, 2);
                break;
            default:
                $costo = 0;
        }
        return $costo;
    }

    public function calculo_costo_suministro_con_dto($obras_id = 0, $camion_dto = null, $material_acarreo_dto = null, $tipo_acarreo = 'EXTERNO')
    {
        if ($tipo_acarreo === 'SUMINISTRO') {
            $tarifa_suministro = $this->CI->tarifa_suministro->tarifa_por_material_obra_proveedor(get_attr_session('usr_cuenta_id'), $material_acarreo_dto->materiales_acarreos_id, $obras_id, $camion_dto->proveedores_id);
            if (is_null($tarifa_suministro)) {
                return false;
            }
            return $tarifa_suministro->costo;
        }
        return 0;
    }
}