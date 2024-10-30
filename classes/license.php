<?php 


namespace MasterElements\Classes;


use MasterElements\Classes\Utils;





defined( 'ABSPATH' ) || exit;





class License{





    public static $instance = null;





    public function activate($key){


        $data = [


            'key' => $key,


        ];


        $o = $this->com_validate($data);


        if($o->validate == 1){


            update_option('__validate_oppai__', $o->oppai);


            Utils::instance()->save_option('license_key', $o->key);


        }


        


        return $o;


    }





    public function revoke(){


        $data = [


            'key' => Utils::instance()->get_option('license_key'),


        ];


        // print_r($data); exit;


        $o = $this->com_revoke($data);


        if($o->validate == 1){


            delete_option('__validate_oppai__');


            Utils::instance()->save_option('license_key', '');


        }


        


        return $o;


    }





    public function com_validate($data = []){


        $data['oppai'] = get_option('__validate_oppai__');


        $data['action'] = 'activate';


        $url = \MasterElements::api_url() . 'license?' . http_build_query($data);


        


        $args = array(


            'timeout'     => 60,


            'redirection' => 3,


            'httpversion' => '1.0',


            'user-agent'  => home_url(),


            'blocking'    => true,


            'sslverify'   => true,


        ); 


        // print_r(wp_remote_get( $url, $args ));


        $res = wp_remote_get( $url, $args );





        return (object) json_decode(


            (string) $res['body']


        ); 


    }





    public function com_revoke($data = []){


        $data['oppai'] = get_option('__validate_oppai__');


        $data['action'] = 'revoke';


        $url = \MasterElements::api_url() . 'license?' . http_build_query($data);


        


        $args = array(


            'timeout'     => 10,


            'redirection' => 3,


            'httpversion' => '1.0',


            'user-agent'  => home_url(),


            'blocking'    => true,


            'sslverify'   => true,


        ); 


        // print_r(wp_remote_get( $url, $args ));


        $res = wp_remote_get( $url, $args );





        return (object) json_decode(


            (string) $res['body']


        );


    }





    public function status(){


        $cached = wp_cache_get( 'elementpress_license_status' );


		if ( false !== $cached ) {


			return $cached;


        }





        $oppai = get_option('__validate_oppai__');


        $key = Utils::instance()->get_option('license_key');


        $status = 'invalid';





        if($oppai != '' && $key != ''){


            $status = 'valid';


        }


        wp_cache_set( 'elementpress_license_status', $status );


        return $status;


    }





    public static function instance() {


        if ( is_null( self::$instance ) ) {





            // Fire the class instance


            self::$instance = new self();


        }





        return self::$instance;


    }


}