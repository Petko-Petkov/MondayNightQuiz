<?php

namespace Controllers;

class Quiz_Controller extends Master_Controller {
	protected $layout = 'default.php';

    public function __construct() {
        parent::__construct(
            get_class(),
            $models = array('quiz'=>'quiz', 'rounds'=>'rounds', 'question' => 'question', 'team' => 'team'),
            'views/quiz/');
    }

    public function index($arguments) {
        $args = array(
            'columns' => 'q.Date, q.QuizzId, t.TeamName, t.TeamId ',
            'table' => '`quizz` q ',
            'join' => '`teams` t ON q.TeamId = t.TeamId ',
            'limit' => htmlspecialchars($arguments[0]),
            'page' => htmlspecialchars($arguments[1]),
            'orderBy' => 'q.Date DESC '
        );

        $quiz = $this->models['quiz']->find($args);
        // var_dump($_SESSION);
        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        include_once $this->layout;
    }

    public function get($id){
        $args = array(
            'table' => '`questions` ',
            'where' => 'quizId = '. $id[0] .' AND roundNumber = '. htmlspecialchars($id[1]),
            'orderBy' => 'questionNumber '
        );
        $questions = $this->models['quiz']->find($args);
        $quiz = $this->models['quiz']->find(array('orderBy'=>'Date DESC '));

        $template_file = DX_ROOT_DIR . $this->views_dir . 'get.php';
        include_once $this->layout;
    }

    public function round($id) {
        $args = array(
            'table' => '`rounds` r ',
            'where' => 'r.quizId = ' . htmlspecialchars($id[0]),
            'columns' => 'r.roundNumber, r.name, r.quizId, r.roundId '
        );
        $rounds = $this->models['rounds']->find($args);
        $questions = $this->models['question']->find(array(
            'where' => 'quizId = ' . $id[0],
            'orderBy' => 'questionNumber'));
        $quiz = $this->models['quiz']->find(array('orderBy'=>'Date DESC '));

        $_SESSION['quiz_master'] = $rounds[0]['teamId'];
        $template_file = DX_ROOT_DIR . $this->views_dir . 'rounds.php';
        include_once $this->layout;
    }

    public function edit( $id ) {
        if ( isset( $_POST['id'] ) ) {
            $quiz = array(
                'id' => htmlspecialchars($_POST['id']),
                'Date' => htmlspecialchars(date("Y-m-d H:i:s", strtotime($_POST['date']))),
                'TeamId' => htmlspecialchars($_POST['select'])
            );

            if ($this->models['quiz']->update('QuizzId', $quiz)){
                $this->addInfoMessage('Quiz edited successfully');
            } else {
                $this->addErrorMessage('Error editing quiz');
            }
            header( 'Location: ' . DX_ROOT_LIBS . 'admin/quiz/view/' . htmlspecialchars($_POST['id'] ));
            exit;
        }
        $rounds = $this->models['rounds']->get('quizId', htmlspecialchars($id[0]));
        $questions = $this->models['question']->find(array(
            'where' => 'quizId = ' . htmlspecialchars($id[0]),
            'orderBy' => 'questionNumber'
        ));
        $quiz = $this->models['quiz']->find( array(
            'where' => 'QuizzId = ' . htmlspecialchars($id[0]),
        ));

        if($this->logged_user['team_id'] != $quiz[0]['TeamId']) {
            $this->redirect('master', 'index');
            exit();
        }

        $teams = $this->models['team']->find();
        $template_file = DX_ROOT_DIR . $this->views_dir . 'edit.php';
        include_once $this->layout;
    }

}