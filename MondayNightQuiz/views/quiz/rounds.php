<div class="bs-component col-lg-12">
    <ul class="nav nav-tabs">
        <?php
        // var_dump($rounds);

            foreach ($rounds as $round) {
                $class = $round['roundNumber'] == 1 ? '" class="active"' : '';
                echo '<li ' . $class . '><a href="#'  . $round['roundId'] . '"  data-toggle="tab" aria-expanded="true">' . $round['name'] . '</a></li>'
                    /*'<a href="' . DX_ROOT_LIBS . 'admin/rounds/edit/' . $round['roundId'] . '" class="btn btn-warning">Edit</a></li>'*/;
            }
        ?>
    </ul>

<div id="myTabContent" class="tab-content">
    <?php
    foreach ($rounds as $round) {
        echo '<div class="tab-pane fade active in" id="' . $round['roundId'] . '">';
        foreach ($questions as $q) {
            if( $q['roundNumber'] === $round['roundNumber'] ) {
                echo '<p>'.$q['questionNumber'] .'. ' . $q['content'] . '</p>';
                    /*'<a href="' . DX_ROOT_LIBS . 'admin/questions/edit/' . $q['questionId'] . '/' . $q['quizId'] . '" class="btn btn-warning"> Редактирай </a>'.
                    '<a href="' . DX_ROOT_LIBS . 'admin/questions/delete/' . $q['questionId'] . '/' . $q['quizId'] . '" class="btn btn-danger"> Изтрий </a>' .*/
                echo '<button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="' . $q['answer'] . '" data-original-title="" title="" aria-describedby="popover601270">Answer</button>';
            }
        }

        echo '</div>';
        /*echo '<a href="' . DX_ROOT_LIBS . 'admin/questions/add/' . $round['roundNumber'] . '/' . $round['quizId'] . '" class="btn btn-warning"> Добави въпрос </a></div>';*/
    }
    ?>
</div>