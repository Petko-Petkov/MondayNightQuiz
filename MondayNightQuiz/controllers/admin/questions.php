<?php
/**
 * Created by PhpStorm.
 * User: Pecata
 * Date: 01.05.2015 г.
 * Time: 17:26
 */

namespace Admin\Controllers;

class Questions_Controller extends Admin_Controller
{

    protected $layout = 'default.php';
    protected $views_dir = 'views/admin/questions/';

    public function __construct()
    {
        parent::__construct(get_class(),
            array(
                'user' => 'user',
                'team' => 'team',
                'quiz' => 'quiz',
                'rounds' => 'rounds',
                'question' => 'question'),
            $this->views_dir);
    }

    public function add($id) {
        if ( isset($_POST['teamId']) ) {
            $question = array(
                'content' => htmlspecialchars($_POST['content']),
                'questionNumber' => htmlspecialchars($_POST['number']),
                'answer' => htmlspecialchars($_POST['answer']),
                'quizId' => htmlspecialchars($id[1]),
                'roundNumber' => htmlspecialchars($id[0]),
                'teamId' => htmlspecialchars($_POST['teamId'])
            );

            $this->models['question']->add($question);
            header( 'Location: ' . DX_ROOT_LIBS . 'admin/quiz/view/' . $id[1] );
            exit;
        }

        $question = $this->models['question']->get('questionId', $id[0]);
        $quiz = $this->models['quiz']->get('QuizzId', $id[1]);

        $template_file = DX_ROOT_DIR . $this->views_dir . 'add.php';
        include_once $this->layout;
    }

    public function edit( $id ) {
        if ( isset( $_POST['questionId'] ) ) {
            $question = array(
                'content' => $_POST['content'],
                'teamId' => $_POST['teamId'],
                'quizId' => $_POST['quizId'],
                'questionNumber' => $_POST['number'],
                'answer' => $_POST['answer'],
                'roundNumber' => $_POST['round'],
                'id' => $_POST['questionId']
            );

            $this->models['question']->update('questionId', $question);
            header( 'Location: ' . DX_ROOT_LIBS . 'admin/quiz/view/' . $id[1] );
            exit;
        }

        $question = $this->models['question']->get( 'questionId', $id[0]);

        $template_file = DX_ROOT_DIR . $this->views_dir . 'edit.php';
        include_once $this->layout;
    }

    public function delete($id) {
        $row = $this->models['question']->delete('questionId', htmlspecialchars($id[0]));

        if($row === 1) {
            $this->addInfoMessage('Successfully deleted question.');
        } else {
            $this->addErrorMessage('Error deleting question');
        }

        header('Location: ' . DX_ROOT_LIBS . 'admin/quiz/view/' . $id[1]);
    }

    public function index($args) {


        $template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
        include_once $this->layout;
    }

    public function view( $id ) {
        $quiz = $this->models['quiz']->get( 'QuizzId', htmlspecialchars($id[0]) );
        $rounds = $this->models['rounds']->get('quizId', htmlspecialchars($id[0]));
        $questions = $this->models['question']->get('quizId', htmlspecialchars($id[0]));

        $template_file = DX_ROOT_DIR . $this->views_dir . 'view.php';
        include_once $this->layout;
    }
}