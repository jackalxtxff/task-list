<?php
session_start();

if ($_POST['type'] == 'all') {
    foreach ($_SESSION['tasks'] as $task) {
        unset($_SESSION['tasks'][array_search($task, $_SESSION['tasks'])]);
    }
}
else {
    unset($_SESSION['tasks'][$_POST['id']]);
}
