<?php
namespace MasterElements\Modules;
use MasterElements\Admin\Attr;

defined( 'ABSPATH' ) || exit;

/**
 * Module registrar.
 *
 * Call assosiated classes of every modules.
 *
 * @since 1.0.0
 * @access public
 */
class Build_Modules{
    public static $instance = null;
    private $core_modules;
    private $active_modules;

    public function __construct(){
        $this->core_modules =  \MasterElements::default_modules();
        $this->active_modules = Attr::instance()->utils->get_option('module_list', $this->core_modules);
      

        foreach($this->active_modules as $module){
            if(in_array($module, $this->core_modules)){
                // make the class name and call it.
              
                $class_name = '\MasterElements\Modules\\'. \MasterElements\Utils::make_classname($module) .'\Init';
                new $class_name();
            }
        }
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire the class instance
            self::$instance = new self();
        }

        return self::$instance;
    }
}