<?php

namespace Controllers;

class Team_Controller extends Master_Controller {

    protected $layout = 'default.php';

    public function __construct() {
        parent::__construct( get_class(), 'team', 'views/teams/' );
        // $this->model = new \Models\Question();
        // echo "Passing through Question Controller created<br />";
    }
}