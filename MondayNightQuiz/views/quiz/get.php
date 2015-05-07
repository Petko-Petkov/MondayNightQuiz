
<?php

if(isset ($_SESSION['team_id'])
    && isset($_SESSION['quiz_master'])
    && $_SESSION['team_id'] == $_SESSION['quiz_master']) {

}

foreach ($questions as $q) {
    echo  '<p>'.$q['questionNumber']. '. ' . $q['content'] . '</p></br>';

}

?>
