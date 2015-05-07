<?php
foreach ($quiz as $kye=>$value) {
    echo '<h3><a href="'.DX_ROOT_LIBS.'quiz/round/' . $value['QuizzId'] . '">' . $value['Date'] . ' Куиз мастъри - ' . $value['TeamName'] . '</a>';
    if($this->is_logged_in && $value['TeamId'] == $this->logged_user['team_id']) {
        echo '<a href="' . DX_ROOT_LIBS . 'quiz/edit/' . $value['QuizzId'] . '" class="btn btn-warning">Edit</a>';
    }
    echo '</h3>';
}
?>

<ul class="pagination">
<?php
$class = ($args['page'] - 1) <= 0 ? 'disabled' : '';
if($args['page'] <= 1) {
    $args['page'] = 1;
}

    $page = ($args['page'] - 1) <= 1 ? 1 : $args['page'] - 1 ;
    echo '<li class="' . $class . '"><a href="' . $page . '">«</a></li>';
    $active = $args['page'];
for($i = 0; $i < count($quiz); $i += $args['limit']){
    echo '<li class="active"><a href="' . DX_ROOT_LIBS . 'quiz/index' . $args['limit'] . '/' . $args['page'] . '">' . $args['page'] . '</a></li>';
}
    echo '<li><a href="' . ($args['page'] + 1) . '">»</a></li>';
?>
</ul>


