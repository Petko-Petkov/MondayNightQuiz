
<div class="col-lg-3"></div>
<div class="col-lg-6">
    <div class="bs-component">
<?php
if(isset ($_SESSION['messages'])){
    foreach ($_SESSION['messages'] as $msg) {
        $type = $msg['type'];
        echo '<div class="alert alert-dismissible alert-' . $type . '">';
        echo '<button type="button" class="close" data-dismiss="alert">×</button>';
        echo '<p>' . htmlspecialchars($msg['text']) . '</p>';
    }

    unset($_SESSION['messages']);
}
?>
    </div>
</div>
<div class="col-lg-3"></div>