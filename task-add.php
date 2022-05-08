<?php
session_start();

$tasks = [
    'name' => htmlentities($_POST['name']),
    'status' => 'Unready',
];

array_push($_SESSION['tasks'], $tasks);