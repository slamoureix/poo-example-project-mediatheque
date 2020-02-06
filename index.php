<?php

require_once __DIR__ . '/config/bootstrap.php';
$bookManager = $container->getBookManager();


if (isset($_GET['book_id']) && isset($_GET['value'])) {
    $book = $bookManager->findOneById($_GET['book_id']);
    $book->setRating($_GET['value']);
    $bookManager->update($book);
}
$books = $bookManager->findAll();


?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container mt-3">
        <h1>HB Library</h1>
        <div class="row">

            <?php foreach ($books as $book) :

            ?>
                <div class="col-4">
                    <div class="card mt-2">
                        <div class="card-header">
                            <a href="template/books/show.php?id=<?= $book->getId() ?>">
                                <?= $book->getTitle() ?>
                            </a>
                            <small>écrit par

                                <a href="template/books/search.php?value=<?= $book->getAuthor() ?>&field=author">
                                    <?= $book->getAuthor() ?>
                                </a>
                            </small></div>
                        <div class="card-body"></div>
                        <div class="card-footer">
                            <div class="pull-right">
                                <?php for ($i = 1; $i < 6; $i++) : ?>
                                    <a href="index.php?book_id=<?= $book->getId() ?>&value=<?= $i ?>">
                                        <i class="fa fa-star<?= $book->getRating() >= $i ? '' : '-o' ?>"></i>
                                    </a>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>