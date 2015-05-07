<?php

namespace Admin\Controllers;

class Quiz_Controller extends Admin_Controller {

	protected $layout = 'default.php';
    protected $views_dir = 'views/admin/quiz/';

	public function __construct() {
		parent::__construct( get_class(),
            array(
                'user'=>'user',
                'team'=>'team',
                'quiz'=>'quiz',
                'rounds'=>'rounds',
                'question'=>'question'),
            $this->views_dir);
	}

	public function add() {
		if ( isset( $_POST['date'] ) ) {
            $args = array(
                'Date' => htmlspecialchars(date("Y-m-d H:i:s", strtotime($_POST['date']))),
                'TeamId' => htmlspecialchars($_POST['teamId'])
            );

			if ($rows = $this->models['quiz']->add( $args )){
                $this->addInfoMessage('Successfully added new quiz');
            } else {
                $this->addErrorMessage('Error creating new quiz');
            }

            header( 'Location: ' . DX_ROOT_LIBS . 'admin/quiz/index' );
            exit;
		}

        $teamArgs = array(
            'table' => 'teams'
        );
        $teams = $this->models['team']->find( $teamArgs );

        $template_file = DX_ROOT_DIR . $this->views_dir . 'add.php';
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

        $quiz = $this->models['quiz']->find( array(
            'where' => 'QuizzId = ' . htmlspecialchars($id[0]),
        ));
        $teams = $this->models['team']->find();
		$template_file = DX_ROOT_DIR . $this->views_dir . 'edit.php';
		include_once $this->layout;
	}

    public function delete($id) {
        if($this->models['quiz']->delete('QuizzId', htmlspecialchars($id[0]))) {
            $this->addInfoMessage('Quiz deleted successfully');
        } else {
            $this->addErrorMessage('Problem deleting quiz');
        }
        $quiz = $this->models['quiz']->find();

        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        include_once $this->layout;
    }

	public function index($args) {
		$quiz = $this->models['quiz']->find();

		$template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
		include_once $this->layout;
	}
	
	public function view( $id ) {
		$quiz = $this->models['quiz']->get( 'QuizzId', htmlspecialchars($id[0]) );
		$rounds = $this->models['rounds']->get('quizId', htmlspecialchars($id[0]));
        $args = array(
            'where' => 'quizId = ' . htmlspecialchars($id[0]),
            'orderBy' => 'questionNumber'
        );
        $questions = $this->models['question']->find($args);
		$template_file = DX_ROOT_DIR . $this->views_dir . 'view.php';
		
		include_once $this->layout;
	}
}