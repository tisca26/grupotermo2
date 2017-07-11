<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ------------- DO NOT UPLOAD THIS FILE TO LIVE SERVER ---------------------
 *
 * Implements code completion for CodeIgniter in PHPStorm.
 * PHPStorm indexes all class constructs, so if this file is in the project it will be loaded.
 *
 * These property values were borrowed from another project.
 * Visit : https://github.com/topdown/phpStorm-CC-Helpers
 *
 * This version is just an upgraded one working with CodeIgniter 3.
 *
 * PHP version 5
 *
 * LICENSE: GPL http://www.gnu.org/copyleft/gpl.html
 *
 * Created 11/12/15, 01:48 PM
 *
 * @category
 * @package    CodeIgniter CI_PHPStorm.php
 * @author     Nicolas Goudry
 * @copyright  2015 Nicolas Goudry
 * @license    GPL http://www.gnu.org/copyleft/gpl.html
 * @version    2015.11.12
 */

/**
 * @description Completion in controllers
 ***************** CORE COMPONENTS *****************
 * @property CI_Benchmark        $benchmark            This class enables you to mark points and calculate the time difference between them. Memory consumption can also be displayed.
 * @property CI_Config           $config               This class contains functions that enable config files to be managed
 * @property CI_Controller       $controller           This class object is the super class that every library in CodeIgniter will be assigned to.
 * @property CI_Exceptions       $exceptions           Exceptions Class
 * @property CI_Hooks            $hooks                Provides a mechanism to extend the base system without hacking.
 * @property CI_Input            $input                Pre-processes global input data for security
 * @property CI_Lang             $lang                 Language Class
 * @property CI_Loader           $load                 Loads framework components.
 * @property CI_Log              $log                  Logging Class
 * @property CI_Model            $model                Model Class
 * @property CI_Output           $output               Responsible for sending final output to the browser.
 * @property CI_Router           $router               Parses URIs and determines routing
 * @property CI_Security         $security             Security Class
 * @property CI_URI              $uri                  Parses URIs and determines routing
 * @property CI_Utf8             $utf8                 Provides support for UTF-8 environments
 ***************** DATABASE COMPONENTS *****************
 * @property CI_DB_forge         $dbforge              Database Forge Class
 * @property CI_DB_query_builder $db                   This is the platform-independent base Query Builder implementation class.
 * @property CI_DB_utility       $dbutil               Database Utility Class
 ***************** CORE LIBRARIES *****************
 * @property CI_Cache            $cache                CodeIgniter Caching Class
 * @property CI_Session          $session              CodeIgniter Session Class
 * @property CI_Calendar         $calendar             This class enables the creation of calendars
 * @property CI_Cart             $cart                 Shopping Cart Class
 * @property CI_Driver_Library   $driver               This class enables you to create "Driver" libraries that add runtime ability to extend the capabilities of a class via additional driver objects
 * @property CI_Email            $email                Permits email to be sent using Mail, Sendmail, or SMTP.
 * @property CI_Encryption       $encryption           Provides two-way keyed encryption via PHP's MCrypt and/or OpenSSL extensions.
 * @property CI_Form_validation  $form_validation      Form Validation Class
 * @property CI_FTP              $ftp                  FTP Class
 * @property CI_Image_lib        $image_lib            Image Manipulation class
 * @property CI_Migration        $migration            All migrations should implement this, forces up() and down() and gives access to the CI super-global.
 * @property CI_Pagination       $pagination           Pagination Class
 * @property CI_Parser           $parser               Parser Class
 * @property CI_Profiler         $profiler             This class enables you to display benchmark, query, and other data in order to help with debugging and optimization.
 * @property CI_Table            $table                Lets you create tables manually or from database result objects, or arrays.
 * @property CI_Trackback        $trackback            Trackback Sending/Receiving Class
 * @property CI_Typography       $typography           Typography Class
 * @property CI_Unit_test        $unit                 Simple testing class
 * @property CI_Upload           $upload               File Uploading Class
 * @property CI_User_agent       $agent                Identifies the platform, browser, robot, or mobile device of the browsing agent
 * @property CI_Xmlrpc           $xmlrpc               XML-RPC request handler class
 * @property CI_Xmlrpcs          $xmlrpcs              XML-RPC server class
 * @property CI_Zip              $zip                  Zip Compression Class
 ***************** DEPRECATED LIBRARIES *****************
 * @property CI_Jquery           $jquery               Jquery Class
 * @property CI_Encrypt          $encrypt              Provides two-way keyed encoding using Mcrypt
 * @property CI_Javascript       $javascript           Javascript Class
 ***************** YOUR LIBRARIES *****************
 * @property Acarreo                        $acarreo                Lib para acarreo
 * @property Auth_lib                       $auth_lib               Autenticar
 * @property Camion                         $camion                 Lib de camiones
 * @property Cargar_elementos_manager       $cargar_elementos_manager   Cargar elementos
 * @property Cat_ubicacion                  $cat_ubicacion          Lib cat ubicaciones
 * @property Catalogo                       $catalogo               Lib de catalogos
 * @property Cliente                        $cliente                Lib cliente
 * @property Correo                         $correo                 Correo lib
 * @property Empresa                        $empresa                Lib de empresas
 * @property Group                          $group                  Lib para group
 * @property Lector_archivos                $lector_archivos        Lib de carga
 * @property Material_acarreo               $material_acarreo       Lib de material acarreo
 * @property Material_servicio              $material_servicio      Lib de material servicio
 * @property Menu_manager                   $menu_manager           Lib para generar menu
 * @property Obra                           $obra                   Lib obras
 * @property Proveedor                      $proveedor              Lib para proveedores
 * @property Tarifa_acarreo                 $tarifa_acarreo         Lib para tarifa acarreo
 * @property User                           $user                   Lib para usuarios
 * @property Zona                           $zona                   Lib de zonas
 ***************** YOUR MODELS *****************
 * @property Acarreos_model                 $acarreos_model             Model de acarreos
 * @property Acl_model                      $acl_model                  Model de Acl
 * @property Archivos_cargados_model        $archivos_cargados_model    Model de archivos cargados
 * @property Camiones_model                 $camiones_model             Model de camiones
 * @property Cat_ubicacion_model            $cat_ubicacion_model        Model de cat ubicaciones
 * @property Catalogos_model                $catalogos_model            Model de catalogos
 * @property Clientes_model                 $clientes_model             Model de cliente
 * @property Ejemplo_carga_model            $ejemplo_carga_model        Model de ejemplo carga
 * @property Empresas_model                 $empresas_model             Model de empresas
 * @property Groups_model                   $groups_model               Model de groups
 * @property Materiales_acarreos_model      $materiales_acarreos_model  Model de materiales acarreos
 * @property Materiales_servicios_model     $materiales_servicios_model Model de materiales servicios
 * @property Menu_model                     $menu_model                 Model de Menu
 * @property Obras_model                    $obras_model                Model de Obra
 * @property Proveedores_model              $proveedores_model          Model de proveedores
 * @property Resources_model                $resources_model            Model de recursos
 * @property Tarifas_acarreos_model         $tarifas_acarreos_model     Model de tarifas acarreos
 * @property Users_model                    $users_model                Model de usuarios
 * @property Zonas_model                    $zonas_model                Model de zonas
 */
class CI_Controller {
    public function __construct() {
    } // This default returns construct as set
}

/**
 ***************** CORE COMPONENTS *****************
 * @property CI_Benchmark        $benchmark            This class enables you to mark points and calculate the time difference between them. Memory consumption can also be displayed.
 * @property CI_Config           $config               This class contains functions that enable config files to be managed
 * @property CI_Controller       $controller           This class object is the super class that every library in CodeIgniter will be assigned to.
 * @property CI_Exceptions       $exceptions           Exceptions Class
 * @property CI_Hooks            $hooks                Provides a mechanism to extend the base system without hacking.
 * @property CI_Input            $input                Pre-processes global input data for security
 * @property CI_Lang             $lang                 Language Class
 * @property CI_Loader           $load                 Loads framework components.
 * @property CI_Log              $log                  Logging Class
 * @property CI_Model            $model                Model Class
 * @property CI_Output           $output               Responsible for sending final output to the browser.
 * @property CI_Router           $router               Parses URIs and determines routing
 * @property CI_Security         $security             Security Class
 * @property CI_URI              $uri                  Parses URIs and determines routing
 * @property CI_Utf8             $utf8                 Provides support for UTF-8 environments
 ***************** DATABASE COMPONENTS *****************
 * @property CI_DB_forge         $dbforge              Database Forge Class
 * @property CI_DB_query_builder $db                   This is the platform-independent base Query Builder implementation class.
 * @property CI_DB_utility       $dbutil               Database Utility Class
 ***************** CORE LIBRARIES *****************
 * @property CI_Cache            $cache                CodeIgniter Caching Class
 * @property CI_Session          $session              CodeIgniter Session Class
 * @property CI_Calendar         $calendar             This class enables the creation of calendars
 * @property CI_Cart             $cart                 Shopping Cart Class
 * @property CI_Driver_Library   $driver               This class enables you to create "Driver" libraries that add runtime ability to extend the capabilities of a class via additional driver objects
 * @property CI_Email            $email                Permits email to be sent using Mail, Sendmail, or SMTP.
 * @property CI_Encryption       $encryption           Provides two-way keyed encryption via PHP's MCrypt and/or OpenSSL extensions.
 * @property CI_Form_validation  $form_validation      Form Validation Class
 * @property CI_FTP              $ftp                  FTP Class
 * @property CI_Image_lib        $image_lib            Image Manipulation class
 * @property CI_Migration        $migration            All migrations should implement this, forces up() and down() and gives access to the CI super-global.
 * @property CI_Pagination       $pagination           Pagination Class
 * @property CI_Parser           $parser               Parser Class
 * @property CI_Profiler         $profiler             This class enables you to display benchmark, query, and other data in order to help with debugging and optimization.
 * @property CI_Table            $table                Lets you create tables manually or from database result objects, or arrays.
 * @property CI_Trackback        $trackback            Trackback Sending/Receiving Class
 * @property CI_Typography       $typography           Typography Class
 * @property CI_Unit_test        $unit                 Simple testing class
 * @property CI_Upload           $upload               File Uploading Class
 * @property CI_User_agent       $agent                Identifies the platform, browser, robot, or mobile device of the browsing agent
 * @property CI_Xmlrpc           $xmlrpc               XML-RPC request handler class
 * @property CI_Xmlrpcs          $xmlrpcs              XML-RPC server class
 * @property CI_Zip              $zip                  Zip Compression Class
 ***************** DEPRECATED LIBRARIES *****************
 * @property CI_Jquery           $jquery               Jquery Class
 * @property CI_Encrypt          $encrypt              Provides two-way keyed encoding using Mcrypt
 * @property CI_Javascript       $javascript           Javascript Class
 ***************** YOUR LIBRARIES *****************
 * @property Layout              $layout               Layout Class
 */
class CI_Model {
    public function __construct() {
    } // This default returns construct as set
}

/* End of file PHPStorm_CI_CC.php */
?>