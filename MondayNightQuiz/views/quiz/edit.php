<ul class="nav nav-tabs">
    <!--<li><a href="#" class="active" data-toggle="tab" aria-expanded="true"></a></li>-->
    <?php
    // var_dump($rounds);

    foreach ($rounds as $round) {
        $class = $round['roundNumber'] == 1 ? '" class="active"' : '';
        echo '<li ' . $class . '><a href="#'  . $round['roundId'] . '"  data-toggle="tab" aria-expanded="true"><h5>' . $round['name'] . '</h5></a></li>';
        /*echo '<a href="' . DX_ROOT_LIBS . 'rounds/index">' . $round['name'] . '</a>' .
            '<a href="' . DX_ROOT_LIBS . 'admin/rounds/edit/' . $round['roundId'] . '" class="btn btn-warning" ">Редактирай</a>' .
            '<a href="' . DX_ROOT_LIBS . 'admin/rounds/add" class="btn btn-warning" ">Добави</a>';*/
    }

    echo '<li><a href="' . DX_ROOT_LIBS . 'admin/rounds/add/' . $quiz[0]['QuizzId'] . '" class="btn btn-warning">Добави кръг</a></li>';
    ?>
</ul>

<div id="myTabContent" class="tab-content">
    <?php
    foreach ($rounds as $round) {
        echo '<div class="tab-pane fade active in" id="' . $round['roundId'] . '">';
        foreach ($questions as $q) {
            if( $q['roundNumber'] === $round['roundNumber'] ) {
                echo '<p>'.$q['questionNumber'] .'. ' . $q['content'] .
                    '<a href="' . DX_ROOT_LIBS . 'admin/questions/edit/' . $q['questionId'] . '/' . $q['quizId'] . '" class="btn btn-warning"> Редактирай </a>'.
                    '<a href="' . DX_ROOT_LIBS . 'admin/questions/delete/' . $q['questionId'] . '/' . $q['quizId'] . '" class="btn btn-danger"> Изтрий </a>' .
                    '</p>';
            }
        }

        echo '<a href="' . DX_ROOT_LIBS . 'admin/questions/add/' . $round['roundNumber'] . '/' . $round['quizId'] . '" class="btn btn-warning"> Добави въпрос </a></div>';
    }
    ?>
</div>