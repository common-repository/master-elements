<?php


namespace MasterElements\Admin;


defined( 'ABSPATH' ) || exit;





class Admin{





	public static $instance = null;





	public static function get_url(){


		return \MasterElements::admin_url() ;


	}


	public static function get_dir(){


		return \MasterElements::admin_dir() ;


	}


    public static function assets_url(){


        return \MasterElements::assets_url() ;


    }





	public static function key(){


		return 'masterelements';


	}





	public function __construct() {





		// register admin menus


		add_action('admin_menu', [$this, 'create_menu']);


	//	add_action('admin_menu', [$this, 'templates_submenu'], 999);


    }





	public function create_menu(){





		// dashboard, main menu


		add_menu_page(


			esc_html__( 'Master Elements', 'Master Elements' ),


			esc_html__( 'Master Elements', 'masterelements' ),


			'manage_options',


			'masterelements',


			[$this, 'dashboard'],


			self::assets_url() . '/images/admin-icon.png',


			2


		);


		//add_submenu_page(


		//	esc_html__('Dashboard', 'masterelements'),


		//	'manage_options',


		//	[$this, 'dashboard'],


		//	2


		//);





	}





	/*public function templates_submenu(){


		add_submenu_page( self::key(), esc_html__( 'Templates', 'masterelements' ), esc_html__( 'Templates', 'masterelements' ), 'manage_options', 'templates', [$this, 'templates'], 11);


	}*/


	function dashboard() //Dashboard Screen after clicked on MasterElements option


	{


		include_once self::get_dir(). 'pages/dashboard.php';


	}


	function options()


	{


		include_once self:: get_dir(). 'pages/settings.php';


	}


	/*function templates() //Templates Screen after clicked on Templates option


	{


		include_once self::get_dir(). 'pages/templates.php';


	}*/





	public static function instance() {


		if ( is_null( self::$instance ) ) {





			// Fire the class instance


			self::$instance = new self();


		}


		return self::$instance;


	}


}