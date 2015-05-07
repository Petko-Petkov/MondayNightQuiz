<?php

namespace Controllers;

class Master_Controller {
	
	protected $layout;
	
	protected $views_dir =  'views/master/';
	
	protected $model = null;
	
	protected $class_name = null;
	
	protected $logged_user = array();

    protected $is_logged_in = false;

    protected $isAdmin = false;

	public function __construct( $class_name = '\Controllers\Master_Controller', $models = array('master'=>'master'/*, 'quiz'=>'quiz'*/), $views_dir = 'views/master/' ) {
		// Get caller classes

        $this->class_name = $class_name;
        $this->views_dir = $views_dir;
        $this->layout = DX_ROOT_DIR . 'views/layouts/default.php';

        foreach ($models as $key => $value) {
            include_once DX_ROOT_DIR . "models/{$value}.php";
            $model_class = "\\Models\\" . ucfirst( $value ) . "_Model";
            $this->models[$key] = new $model_class( array( 'table' => 'none' ) );
        }

        $auth = \Lib\Auth::get_instance();
        $this->is_logged_in = $auth->is_logged_in();
        $logged_user = $auth->get_logged_user();
        $this->logged_user = $logged_user;
        $this->isAdmin = $auth->isAdmin();

        if (!isset($_SESSION['quizzes'])) {
            $quizzes = $this->models['master']->find(array(
                'columns' => 'q.Date, q.QuizzId, t.TeamName ',
                'table' => '`quizz` q ',
                'join' => '`teams` t ON q.TeamId = t.TeamId ',
                'limit' => 5,
                'orderBy' => 'q.Date DESC '));
            // $users = $this->models['master']->find(array('table'=>'users'));
            $_SESSION['quizzes'] = $quizzes;
        }

        if (!isset($_SESSION['count'])) {
            $count = $this->models['master']->find(array(
                'table' => 'quizz ',
                'columns' => 'COUNT(QuizzId) '
            ));
            $_SESSION['count'] = $count;
        }
    }
    public function index($args) {
        $articles = $this->models['master']->find(array('table'=>'articles'));
        $quizzes = $this->models['master']->find(array(
            'columns' => 'q.Date, q.QuizzId, t.TeamName ',
            'table' => '`quizz` q ',
            'join' => '`teams` t ON q.TeamId = t.TeamId ',
            'limit' => 5,
            'orderBy' => 'q.Date DESC '));
        // $users = $this->models['master']->find(array('table'=>'users'));
        $_SESSION['quizzes'] = $quizzes;

        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        include_once $this->layout;
    }

    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }

    public function redirect(
        $controllerName, $actionName = null, $params = null) {
        $url = '/' . urlencode($controllerName);
        if ($actionName != null) {
            $url .= '/' . urlencode($actionName);
        }
        if ($params != null) {
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }

    function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        };
        array_push($_SESSION['messages'],
            array('text' => $msg, 'type' => $type));
    }

    function addInfoMessage($msg) {
        $this->addMessage($msg, 'success');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'error');
    }


    /*public function home() {
        $articles = $this->models['master']->find(array('table'=>'articles'));
        $quiz = $this->models['master']->find(array('table'=>'quizz', 'orderBy'=>'Date DESC '));
        $users = $this->models['master']->find(array('table'=>'users'));

        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        include_once $this->layout;
    }*/
}