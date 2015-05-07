
    <p>Създай нов куиз: <?php echo '<a href="' . DX_ROOT_LIBS . 'admin/quiz/add" class="btn btn-danger">Добави</a>';?></p>

<?php foreach( $quiz as $q) {
    echo '<p>' . $q['Date'];
    echo '<a href="' . DX_ROOT_LIBS . 'admin/quiz/edit/' . htmlspecialchars($q['QuizzId']) . '" class="btn btn-warning">Edit</a>';
    echo '<a href="' . DX_ROOT_LIBS . 'admin/quiz/delete/' . htmlspecialchars($q['QuizzId']) . '" class="btn btn-warning">Delete</a></p>';
}
?>