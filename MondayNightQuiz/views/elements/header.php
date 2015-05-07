<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monday night quiz</title>


    <?php
        echo '<script src="/lib/js/jquery-2.1.1.min.js"></script>';
        echo '<link href="/lib/css/bootstrap.min.css" rel="stylesheet">';
        echo '<link href="/lib/css/bootstrap-theme.min.css" rel="stylesheet">';
        echo '<link href="/lib/css/styles.css" rel="stylesheet">';
        echo '<script src="/lib/js/bootstrap.min.js"></script>';
        echo '<link rel="/stylesheet" href="lib/css/jquery-ui.min.css">';
        echo '<script src="/lib/js/jquery-ui.min.js"></script>';
    ?>

    <script>
        $(function() {
            $( "#accordion" ).accordion();
        });
    </script>
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
</head>
<body>
<header class="navbar navbar-fixed-top effect2" id="header">
    <div class="container">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button><!--
        <div class="navbar-header">
            <a href="#" class="navbar-brand pull-left"><img src="img/PecataKokiLogo.jpg" alt="logo" class="img-circle"/></a>
        </div>-->
        <div class="menu-container pull-right">
            <div class="collapse navbar-collapse navHeaderCollapse">
                <ul class="current nav navbar-nav navbar-right">
                    <?php
                    echo '<li class="active"><a href="' . DX_ROOT_LIBS . 'Index" id="home">Home</a></li>';
                    echo '<li><a href="' . DX_ROOT_LIBS . 'quiz/index/5/1" id="images">Quiz</a></li>';
                    echo '<li><a href="' . DX_ROOT_LIBS . 'question/index" id="blog">Questions</a></li>';
                    echo '<li><a href="' . DX_ROOT_LIBS . 'about/index" id="about">About</a></li>';
                    echo '<li><a href="' . DX_ROOT_LIBS . 'contact/index" id="contact" data-toggle="modal">Contact</a></li>';
                    echo '<li><a href="' . DX_ROOT_LIBS . 'login/Index" id="user-interaction" data-toggle="modal"><span
                                class="glyphicon glyphicon-user"></span></a></li>';
                    ?>
                </ul>
            </div>
            <?php if( ! empty( $this->logged_user ) ): ?>
                <div id="user_center">
                    <p>
                        <?php
                            echo 'Welcome, '. $this->logged_user['username'];
                            echo '<a href="' . DX_ROOT_LIBS . 'user/logout" class="btn btn-danger"> Logout</a>';
                            if($this->isAdmin) {
                                echo '<a href="' . DX_ROOT_LIBS . 'admin/quiz/index" class="btn btn-danger">Admin Panel</a>';
                            }
                        ?>
                    </p>
                </div>
                <?php else : ?>
                <div id="user_center">
                    <p>
                        Welcome, Guest?
                        <?php
                            echo '<a href="' . DX_ROOT_LIBS . 'user/login" class="btn btn-default">Login</a> or ';
                            echo '<a href="' . DX_ROOT_LIBS . 'user/register" class="btn btn-warning">Register</a>';
                        ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<body>
<section id="main" class="col-md-12">
    <section id="content" class="col-md-9">
        <?php include_once('notifications.php')?>
        <div class="col-lg-2"></div>
        <div class="col-lg-8">


