<?php foreach ($articles as $article) {
        echo '<div class="bs-component"><div class="panel panel-danger"><div class="panel-heading">';
        echo '<h3 class="panel-title">' . $article['title'] . '</h3></div>';
        echo '<div class="panel-body">' . $article['content'] . '</div>';
        echo '<div class="panel-footer"><p class="text-muted">Authored by Pecata on ' . $article['date'] . ' </p></div></div>';
    }
?>

<ul class="pagination">
    <li class="disabled"><a href="#">«</a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">»</a></li>
</ul>