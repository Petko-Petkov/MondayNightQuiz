<?php

namespace Admin\Controllers;

class Rounds_Controller extends Admin_Controller
{
    protected $layout = 'default.php';
    protected $views_dir = 'views/admin/rounds/';

    public function __construct()
    {
        parent::__construct(get_class(),
            array(
                'user' => 'user',
                'team' => 'team',
                'quiz' => 'quiz',
                'rounds' => 'rounds'),
            $this->views_dir);
    }

    function edit($id) {
        if ( isset( $_POST['id'] ) ) {
            $round = array(
                'id' => htmlspecialchars($_POST['id']),
                'name' => htmlspecialchars($_POST['name']),
                'roundNumber' => htmlspecialchars($_POST['roundNumber'])
            );

            if ($this->models['rounds']->update('roundId', $round)){
                $this->addInfoMessage('Successfully edited round!');
            } else {
                $this->addErrorMessage('Error editing round');
            }

            header( 'Location: ' . DX_ROOT_LIBS . 'admin/quiz/view/' . htmlspecialchars($_POST['quizId'] ));
            exit;
        }

        $quiz = $this->models['quiz']->find( array('where' => 'QuizzId = ' . htmlspecialchars($id[0])));
        $round = $this->models['rounds']->get('roundID', htmlspecialchars($id[0]));
        $teams = $this->models['team']->find();

        $template_file = DX_ROOT_DIR . $this->views_dir . 'edit.php';
        include_once $this->layout;
    }

    function add($id) {
        if ( isset( $_POST['id'] ) ) {
            $args = array(
                'name' => htmlspecialchars($_POST['name']),
                'roundNumber' => htmlspecialchars($_POST['roundNumber']),
                'quizId' => htmlspecialchars($id[0])
            );

            $rows = $this->models['rounds']->add( $args );
            header('Location: ' . DX_ROOT_LIBS . 'admin/quiz/view/' . htmlspecialchars($id[0]));
            exit;
        }
/*
        $teamArgs = array(
            'table' => 'teams'
        );
        $teams = $this->models['team']->find( $teamArgs );*/
        // var_dump($teams); die;
        // $quiz = $this->models['quiz']->get('QuizzId', $id);

        $id = $id[0];
        $template_file = DX_ROOT_DIR . $this->views_dir . 'add.php';
        include_once $this->layout;
    }
}
