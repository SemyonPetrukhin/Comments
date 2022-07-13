<?php

require('database/db.php');

$username = '';
$comment = '';
$errMsg = [];
$status = 0;
$comments = [];


//Код для формы создания комментария
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {

    $username = trim($_POST['username']);
    $comment = trim($_POST['textComment']);


    if ($username === '' || $comment === '') {
        array_push($errMsg, "Пожалуйста, заполните все поля");
    } elseif (mb_strlen($comment, 'UTF-8') < 5) {
        array_push($errMsg, "Комментарий должен содержать более 5 символов");
    } else {
        $comment = [
            'status' => $status,
            'username' => $username,
            'comment' => $comment
        ];
        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['status' => 0]);
    }
} else {
    $username = '';
    $comment = '';
    $comments = selectAll('comments', ['status' => 0]);
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="assets/icons.css">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Комментарии</title>
</head>

<body>
    <div class="container-fluid text-center col-md-4 offset-md-4 mt-5">

        <!--Форма ввода комментария-->
        <form action="index.php" method="post">

            <div class="row">
                <div class="col-md-12 text-start">
                    <h3>Your comment:</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <input name="username" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <textarea name="textComment" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write your comment"></textarea>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-4 text-start">
                    <button name="goComment" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

        <!--Вывод комментариев-->
        <?php if (count($comments) > 0) : ?>

            <div class="row mt-5">
                <div class="col-md-4 text-start">
                    <h3>Comments:</h3>
                </div>
            </div>

            <div class="row flex-column">

                <?php foreach ($comments as $comment) :
                    $comment['username'] = "@" . strtolower($comment['username']);
                ?>

                    <div class="border-top col-md-12 mt-2 pt-1">

                        <div class="text-start col-12">
                            <i class="fa-solid fa-user-tie"></i>
                            <h6 class="ms-1 d-inline">
                                <?= $comment['username'] ?>
                            </h6>
                        </div>

                        <div class="col-11 text-start text-break mt-2 ms-4">
                            <p>
                                <?= $comment['comment'] ?>
                            </p>
                        </div>

                        <div class="text-start fs-6">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span><?= $comment['created_date'] ?></span>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else : ?>

            <div class="row mt-5">
                <div class="col-md-4 text-start">
                    <h3>No comments</h3>
                </div>
            </div>

        <?php endif; ?>

    </div>

    <footer class="container-fluid mt-5 bg-dark text-center text-white">
        <span>
            Made with <i class="fa-solid fa-heart"></i> by <a class="text-decoration-none primary" href="https://github.com/SemyonPetrukhin">Semyon</a>
        </span>
    </footer>

</body>

</html>