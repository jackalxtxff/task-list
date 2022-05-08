<?php
    session_start();
    if(!isset($_SESSION['tasks'])){
        $_SESSION['tasks'] = [];
    }
    $tasks = [
            0 => [
                    'name' => 'hello',
                    'ready' => true,
            ]
    ];
//    print_r($_SESSION['tasks']);
//    print_r(count($_SESSION['tasks']));
//    session_destroy()
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            border: 1px solid transparent;
            font-size: 1rem;
            border-radius: 0.25rem;
            padding 0.375rem 0.75rem;
        }
        .btn-dark {
            color: #fff;
            background-color: #212529;
            border-color: #212529;
        }
        .btn-light {
            color: #000;
            border-color: #212529;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card task-list-wrapper">
            <h3 style="text-align: center">Task List</h3>
            <hr>
            <div class="task-manage">
                <div>
                    <input type="text" class="task-name">
                    <button class="btn btn-dark btn-add">Add Task</button>
                </div>
                <button class="btn btn-light btn-delete" data-type="all">Remove All</button>
                <button class="btn btn-light btn-update" data-type="all">Ready All</button>
                <hr>
            </div>
            <div class="task-list">
                <?php
                foreach ($_SESSION['tasks'] as $task) {
                    $color = $task['status'] == 'Ready' ? 'green' : 'red';
                    echo '<div class="task-item">
                        <div style="display: flex">
                            <div style="width: 80%; float: left">
                                <p class="task-name">'.$task["name"].'</p>
                                <button class="btn btn-light btn-update" data-type="one" data-status="'.$task['status'].'" data-id="'.array_search($task, $_SESSION['tasks']).'">'.$task['status'].'</button>
                                <button class="btn btn-light btn-delete" data-type="one" data-id="'.array_search($task, $_SESSION['tasks']).'">Delete</button>
                            </div>
                            <div style="width: 20%; float: right; align-self: center">
                                <div style="width:40px; height:40px; border: 1px solid '.$color.'; border-radius: 100%"></div>
                            </div>
                        </div>
                        <hr>
                    </div>';
                }
                ?>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '.btn-add', function() {
            let name = $('.task-name').val();
            if (name.length < 1) alert('Введите название');
            else {
                $.ajax({
                    url: 'task-add.php',
                    type: 'POST',
                    data: {
                        name: name
                    },
                    success: function(data) {
                        console.log('success', data);
                        location.reload();
                    }
                });
            }
        });
        $(document).on('click', '.btn-delete', function() {
            let id = null;
            let type = $(this).data('type');
            if (type == 'one') {
                id = $(this).data('id');
            }
            $.ajax({
                url: 'task-del.php',
                type: 'POST',
                data: {
                    id: id,
                    type: type
                },
                success: function(data) {
                    console.log('success', data);
                    location.reload();
                }
            });
        });
        $(document).on('click', '.btn-update', function() {
            let id = null;
            let status = null;
            let type = $(this).data('type');
            if (type == 'one') {
                id = $(this).data('id');
                status = $(this).data('status');
            }
            $.ajax({
                url: 'task-upd.php',
                type: 'POST',
                data: {
                    id: id,
                    status: status,
                    type: type
                },
                success: function(data) {
                    console.log('success', data);
                    location.reload();
                }
            });
        });
    </script>
</body>
</html>