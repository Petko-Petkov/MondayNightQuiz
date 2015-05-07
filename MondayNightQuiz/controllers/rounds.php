<?php

namespace Controllers;

class Rounds_Controller extends Master_Controller {

    protected $layout = 'default.php';

    public function __construct() {
        parent::__construct( get_class(), array('rounds' => 'rounds'), 'views/teams/' );
    }
}