<?php

namespace Lib;

class Auth {

    private static $session = null;
    private static $is_logged_in  = false;
    private static $logged_user = array();
    private static $isAdmin = false;
    private $dbconn;

    private function __construct() {
        // Session lifetime = 60min
        session_set_cookie_params(3600,"/");


        if(!empty($_SESSION['username'])){
            self::$is_logged_in = true;
            self::$logged_user = array(
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username']
            );
        }
	}

    public static function get_instance() {
		static $instance = null;

		if ( null === $instance ) {
			$instance = new static();
		}

		return $instance;
	}

    public function isAdmin() {
        if(isset( $_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            return true;
        }

        return false;
    }

    public function is_logged_in() {
		if ( isset( $_SESSION['username'] ) ) {
			return true;
		}
		return false;
	}

    public function get_logged_user() {
        if ( ! isset( $_SESSION['username'] )  ) {
            return array();
        }

        return array(
            'username' => $_SESSION['username'],
            'user_id' => $_SESSION['user_id'],
            'team_id' => $_SESSION['team_id']
        );
    }

    public function login( $username, $password ) {
		$db = \Lib\Database::get_instance();
		$dbconn = $db->get_db();

		$statement = $dbconn->prepare( "SELECT UserId, Username, isAdmin, TeamId
                                        FROM users
                                        WHERE username = ?
                                          AND password = MD5( ? ) LIMIT 1" );
        $statement->bind_param( 'ss', $username, $password );

        $statement->execute();

		$result_set = $statement->get_result();

		if ( $row = $result_set->fetch_assoc() ) {
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $row['UserId'];
            $_SESSION['team_id'] = $row['TeamId'];
            $row['isAdmin'] === 1 ? $_SESSION['isAdmin'] = true : $_SESSION['isAdmin'] = false;
			return true;
		}

		return false;
	}


    public function register($args) {
        $db = \Lib\Database::get_instance();
        $dbconn = $db->get_db();
        $tables = array();
        $values = array();
        foreach($args as $key => $value){
            $tables[] = '`'.$dbconn->real_escape_string($key).'`';
            $values[] = '"'.$dbconn->real_escape_string($value).'"';
        }

        $tables_str = implode(', ', $tables);
        $values_str = implode(', ', $values);
        $statement = $dbconn->prepare("INSERT INTO `users` ( $tables_str ) VALUES ( $values_str )");
        $statement->execute();

        if ( $statement->affected_rows === 1 ) {
            $login_statement = $dbconn->prepare("SELECT UserId FROM users WHERE username = ? AND password =  ?  LIMIT 1");
            $login_statement->bind_param('ss', $args['UserName'], $args['Password']);
            $login_statement->execute();

            $result_state = $login_statement->get_result();

            if($row = $result_state->fetch_assoc()) {
                $_SESSION['username'] = $args['UserName'];
                $_SESSION['user_id'] = $row['UserId'];
            }

            return true;
        } else {
            return false;
        }
    }
    public function logout( ) {
		session_destroy();
	}
}