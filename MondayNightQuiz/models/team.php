<?php
/**
 * Created by PhpStorm.
 * User: Pecata
 * Date: 25.04.2015 г.
 * Time: 23:02
 */

namespace Models;

class Team_Model extends \Models\Master_Model {

    public function __construct( $args = array() ) {
        parent::__construct( array(
            'table' => 'teams'
        ) );
    }

    public function get_questions() {
        return parent::find( );
    }
}