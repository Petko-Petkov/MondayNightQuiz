<?php

namespace Admin\Controllers;

class Admin_Controller extends \Controllers\Master_Controller {
	
	public function __construct( $class_name = '\Admin\Controllers\Admin_Controller', $model = 'master', $views_dir = '/views/admin/' ) {
		parent::__construct( get_class(), $model, $views_dir );

        $auth = \Lib\Auth::get_instance();
		$logged_in = $auth->is_logged_in();
        $isAdmin = $auth->isAdmin();
		
		if( ! $logged_in ) {
			header( 'Location: /' );
			exit();
		}

        if(!$isAdmin) {
            header('Location: /');
            exit();
        }
	}
}