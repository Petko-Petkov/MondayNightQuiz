<?php

namespace Controllers;

class Question_Controller extends Master_Controller {

    protected $layout = 'default.php';

    public function __construct() {
        parent::__construct(
            get_class(),
            $models = array('question'=>'question', 'rounds'=>'rounds', 'quiz'=>'quiz'),
            'views/questions/' );
        // $this->model = new \Models\Question();
        // echo "Passing through Question Controller created<br />";
    }

    public function index($args) {
        $questions = $this->models['question']->find(array(
            'limit'=>10,
            'orderBy'=>'questionNumber'));
        $quiz = $this->models['quiz']->find(array('table'=>'quizz', 'orderBy'=>'Date DESC '));

        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        include_once $this->layout;
    }
}