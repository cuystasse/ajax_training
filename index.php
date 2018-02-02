<?php

$cards = [];

if (isset($_GET['input-search'])) {
    $search = str_replace(' ', '+', $_GET['input-search']);

    $cards = file_get_contents("https://api.magicthegathering.io/v1/cards?name=" . $search);
    $cards = json_decode($cards, true)['cards'];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <title>MTG Ajax</title>
</head>
<body>

<div class="container">
    <div class="row">
        <h1>MY LITTLE MTG API AJAX</h1>

        <form id="form-search" action="#" method="get" role="form">
            <legend>Search cards form</legend>

            <div class="form-group">
                <label for="search">Search <span class="loading"><i class="fas fa-cog fa-spin"></i></span></label>
                <input type="text" class="form-control" name="input-search" id="search"
                       placeholder="search cards here...">
                <div class="suggest"></div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


        <?php if ($cards): ?>
            <h2>Results</h2>

            <?php foreach ($cards as $card): ?>
                <?php if (isset($card['imageUrl'])): ?>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <a href="#" class="thumbnail">
                            <h3><?= $card['name'] ?></h3>
                            <img src="<?= $card['imageUrl'] ?>" alt="">
                        </a>
                    </div>
                <?php endif ?>
            <?php
            endforeach;
        endif;
        ?>

    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="main.js"></script>
</body>
</html>