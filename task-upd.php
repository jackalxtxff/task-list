<?php
session_start();

if ($_POST['type'] == 'all') {
    foreach ($_SESSION['tasks'] as $task) {
        $_SESSION['tasks'][array_search($task, $_SESSION['tasks'])]['status'] = 'Ready';
    }
}
else {
    if ($_POST['status'] == 'Ready') {
        $_SESSION['tasks'][$_POST['id']]['status'] = 'Unready';
    }
    else {
        $_SESSION['tasks'][$_POST['id']]['status'] = 'Ready';
    }
}
