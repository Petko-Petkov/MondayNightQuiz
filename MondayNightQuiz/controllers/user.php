<?php

namespace Controllers;

class User_Controller extends Master_Controller
{
    public function __construct()
    {
        parent::__construct(get_class(), array('user'=>'user'), 'views/user/');

    }

    public function login()
    {
        $auth = \Lib\Auth::get_instance();
        $user = $auth->get_logged_user();
        $user_logged_in = $auth->is_logged_in();
        $redirect_view = 'login.php';

        if (empty($user) && isset($_POST['username']) && isset($_POST['password'])) {

            $logged_in = $auth->login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));

            if (!$logged_in) {
                $this->addErrorMessage('Login not sucessfull');
                exit;
            } else {
                $this->isAdmin = $auth->isAdmin();
                $this->addInfoMessage('Welcome back' . htmlspecialchars($_POST['username']));
                header('Location: ' . DX_ROOT_LIBS . 'index' , true);
                exit();
            }
        }

        if ($user_logged_in) {
            $template_file = DX_ROOT_DIR . 'views\master\index.php';
        } else {
            $template_file = DX_ROOT_DIR . $this->views_dir . $redirect_view;
        }

        include_once $this->layout;
    }

    public function register()
    {
        $auth = \Lib\Auth::get_instance();

        $teams = $this->models['user']->find(array(
            'table' => 'teams'
        ));

        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeatPassword'])) {
            if ($_POST['password'] === $_POST['repeatPassword']) {
                $args = array(
                    "FirstName" => isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '',
                    "LastName" => isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '',
                    "UserName" => htmlspecialchars($_POST['username']),
                    "Password" => htmlspecialchars(md5($_POST['password'])),
                    "Email" => isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '',
                    "TeamId" => htmlspecialchars($_POST['team'])
                );

                $registered_user = $auth->register($args);

                if ($registered_user) {
                    header('Location: index' /*. DX_ROOT_HOST . DX_ROOT_HOME */, true);
                    $this->addInfoMessage('Welcome ' . htmlspecialchars($_POST['username']));
                    exit();
                } else {
                    $this->addErrorMessage('Error registering');
                }
            }
        } else {
            $this->addErrorMessage('Missing username ot passwords do no match!');

        }

        $template_file = DX_ROOT_DIR . $this->views_dir . 'register.php';
        include_once $this->layout;
    }

    public function index($args)
    {
        $auth = \Lib\Auth::get_instance();
        $user = $auth->get_logged_user();
        $is_logged_in = $auth->is_logged_in();
        $redirect_view = '';

        if ($is_logged_in) {
            $this->addInfoMessage('Welcome back ' . $_POST['username']);
            $redirect_view = 'index.php';
        } else {
            $this->addErrorMessage('Not allowed here. Please login first!');
            $redirect_view = 'protected.php';
        }

        $template_file = DX_ROOT_DIR . $this->views_dir . $redirect_view;
        include_once $this->layout;
    }

    public function logout()
    {
        $auth = \Lib\Auth::get_instance();

        $auth->logout();
        $this->addInfoMessage('Good bye!');
        header('Location: /' . DX_ROOT_PATH . 'index', true);
        exit();
    }
}
