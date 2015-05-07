</section>
<section id="aside" class="col-lg-3" >
    <div class="bs-component">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Latest quizzes</h1>
            </div>
            <div class="panel-body">
    <?php
        foreach ($_SESSION['quizzes'] as $q) {
            echo '<p><h3><a href="' . DX_ROOT_LIBS . 'quiz/round/' . $q['QuizzId'] . '">Куизът на ' . $q['TeamName'] . '<br/> от ' . $q['Date'] . '</a></h3></p>';
        }
/*
        if(isset($rounds)){
            foreach ($rounds as $round) {
                echo '<p><h3><a href="round/' . $q['QuizzId'] . '">' . $q['Date'] . '</a></h3></p>';
            }
        }*/
    ?>
            </div>
        </div>
    </div>
</section>