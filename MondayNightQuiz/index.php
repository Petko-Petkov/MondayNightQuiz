<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

define( 'DX_ROOT_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR );
define( 'DX_ROOT_PATH', basename( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR );
define( 'DX_ROOT_HOST', $_SERVER['HTTP_HOST'] );
define( 'DX_ROOT_HOME', $_SERVER['REQUEST_URI'] );
define( 'DX_ROOT_LIBS', 'HTTP://' . DX_ROOT_HOST . DIRECTORY_SEPARATOR . DX_ROOT_PATH);

// Bootstrap
include_once 'config/init.php';

$request = $_SERVER['REQUEST_URI'];
$request_home = DIRECTORY_SEPARATOR . DX_ROOT_PATH;
$controller = 'master';
$method = 'index';
$admin_routing = false;
$param = array();

include_once 'controllers/master_controller.php';

if( !empty( $request ) ){
    $request_home = str_replace('\\', '/', $request_home);

    if( 0 === strpos( $request, $request_home ) ){

        $request = substr($request, strlen($request_home));

        if( 0 === strpos( $request, 'admin' ) ) {

            $admin_routing = true;
            include_once 'controllers/admin/admin.php';
            $request = substr( $request, strlen( 'admin/' ) );
        }

        $components = explode( '/', $request, 3 );

        if(1 < count( $components )){
            list( $controller, $method ) = $components;

            if( isset( $components[2] ) ){
                $param = explode('/', $components[2]);
            }
        }
    }
}


$master_controller = new \Controllers\Master_Controller();
$admin_folder = $admin_routing ? 'admin/' : '';/*
$admin_route = $admin_routing ? 'admin\\' : '';*/

if ( isset( $controller ) && file_exists( DX_ROOT_DIR . 'controllers/' . $admin_folder . $controller . '.php' ) ) {
    include_once 'controllers/' . $admin_folder . $controller . '.php';
    $admin_namespace = $admin_routing ? '\Admin' : '';
    $controller_class = $admin_namespace . '\\Controllers\\' . ucfirst( $controller ) . '_Controller';
    $instance = new $controller_class();

    if( method_exists( $instance, $method ) ) {
        call_user_func_array( array( $instance, $method ), array( $param ) );
    } else {
        call_user_func_array( array( $instance, 'index' ), array() );
    }
} else {
    $master_controller->index($args);
}

/*$controller_class = '\Controllers\\' . ucfirst( $controller ) . '_Controller';
$instance = new $controller_class();

if( method_exists( $instance, $method ) ){
    call_user_func_array( array( $instance, $method ), array( $param ) );
}*/

// $db_object = \Lib\Database::get_instance();
// $db_conn = $db_object::get_db();
/*
// Define root dir and root path
define( 'DX_DS', DIRECTORY_SEPARATOR );
define( 'DX_DSW', '/');
define( 'DX_ROOT_DIR', dirname( __FILE__ ) . DX_DS );
define( 'DX_ROOT_PATH', basename( dirname( __FILE__ ) ) . DX_DSW );
define( 'DX_ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/cframe/' );

// Bootstrap
include 'config/db.php';
include_once 'lib/database.php';
include_once 'lib/auth.php';
include_once 'controllers/master_controller.php';
include_once 'models/master.php';

// Define the request home that will always persist in REQUEST_URI
$request_home = DX_DSW . DX_ROOT_PATH;

// var_dump($request_home);

// Read the request
$request = $_SERVER['REQUEST_URI'];
$components = array();
$controller = 'Master';
$method = 'index';
$admin_routing = false;
$param = array();

$master_controller = new \Controllers\Master_Controller();

if ( ! empty( $request ) ) {

    if( 0 === strpos( strtolower($request), strtolower($request_home )) ) {

    	// Clean the request
		$request = substr( $request, strlen( $request_home ) );

		// Switch to admin routing
		if( 0 === strpos( $request, 'admin' ) ) {
			$admin_routing = true;
			include_once 'controllers/admin/admin.php';
			$request = substr( $request, strlen( 'admin/' ) );
		}
		
		
		// Fetch the controller, method and params if any
		$components = explode( DX_DSW, $request, 3 );

		// Get controller and such
		if ( 1 < count( $components ) ) {
			list( $controller, $method ) = $components;
			$param = isset( $components[2] ) ? $components[2] : array();
		}
	}
}

// If the controller is found
if ( isset( $controller ) && file_exists( 'controllers/' . $controller . '.php' ) ) {
	$admin_folder = $admin_routing ? 'admin/' : '';

	include_once 'controllers/' . $admin_folder . $controller . '.php';
	
	// Is admin controller?
	$admin_namespace = $admin_routing ? '\Admin' : '';
	
	// Form the controller class
	$controller_class = $admin_namespace . '\Controllers\\' . ucfirst( $controller ) . '_Controller';

	$instance = new $controller_class();
	
	// Call the object and the method
	if( method_exists( $instance, $method ) ) {
        // var_dump($instance);
		call_user_func_array( array( $instance, $method ), array( $param ) );

// 		$instance->$method();
	} else {
		// fallback to index
		call_user_func_array( array( $instance, 'index' ), array() );
	}
} else {

	$master_controller->home();
}
// \Lib\Auth::get_instance()->logout();

// TEST PLAYGROUND
/* include_once 'models/question.php';

$question_model = new \Models\Question_Model();

$quiz = $question_model->find();

var_dump( $quiz );
*/

// include_once 'lib/auth.php';
// $auth = \Lib\Auth::get_instance();

// $logged_in = $auth->user( 'test', 'test' );

// var_dump($logged_in);

// var_dump($_SESSION);*/