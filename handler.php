<?php
namespace MasterElements;

defined( 'ABSPATH' ) || exit;
/**
 * MasterElements - the God class.
 * Initiate all necessary classes, hooks, configs.
 *
 * @since 0.1
 */


if(!class_exists('\MasterElements\Handler')):
class Handler{
	/**
	 * The plugin instance.
	 * @since 0.1
	 * @access public
	 * @var Handler
	 */
    public static $instance = null;

    public function __construct() {

        // Call the method for MasterElements autoloader.
        $this->registrar_autoloader();
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin'] );
        Admin\Admin::instance();

    }
    public function enqueue_admin(){
        $screen = get_current_screen();
        if(!in_array($screen->id, ['nav-menus', 'edit-metemplate'])){
            return;
        }
    }

    private function registrar_autoloader() {
        require_once \MasterElements::plugin_dir() . '/autoloader.php';
        Autoloader::run();
    }


    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();

        }

        return self::$instance;
    }
}

//Run the instance.
Handler::instance();

endif;