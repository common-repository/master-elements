<?php
namespace MasterElements;

defined( 'ABSPATH' ) || exit;

/**
 * MasterElements autoloader.
 */
if(!class_exists('\MasterElements\Autoloader')):

    class Autoloader {
        
        /**
         * Run autoloader.
         * Register a function as `__autoload()` implementation.
         */
        public static function run() {
            spl_autoload_register( [ __CLASS__, 'autoload' ] );
        }
        private static function autoload( $class_name ) {

            // If the class being requested does not start with our prefix
            // we know it's not one in our project.
            if ( 0 !== strpos( $class_name, __NAMESPACE__ ) ) {
                return;
            }
            
            $file_name = strtolower(
                preg_replace(
                    [ '/\b'.__NAMESPACE__.'\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
                    [ '', '$1-$2', '-', DIRECTORY_SEPARATOR],
                    $class_name
                )
            );

            // Compile our path from the corosponding location.
            $file = trailingslashit(plugin_dir_path( __FILE__ )) . $file_name . '.php';

            // If a file is found.
            if ( file_exists( $file ) ) {
                // Then load it up!
                require_once( $file );
            }
        }
    }

endif;