<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $flassMessge = $message->getMessage();

    if (!empty($flassMessge["msg"])) {
        $message->clearMessage();
    }

    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(false);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Mania</title>
    <link rel="short icon" href="<?= $BASE_URL ?>img/moviemania.ico">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
    <!-- BOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.css" integrity="sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?= $BASE_URL ?>" class="navbar-brand">
                <img src="<?= $BASE_URL ?>img/logo.svg" alt="MovieMania" id="logo">
                <span id="moviemania-title">Movie Mania</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
            target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <form action="" method="GET" id="search-form" class="form-inline my-2 my-lg-0 input-group">
                <input type="text" name="q" id="search" class="form-control" type="search" 
                placeholder="Buscar filmes" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <?php if($userData): ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>newmovie.php" class="nav-link" id="ent-reg">
                                <i class="fas fa-plus-square"></i> <!-- Ícone separado -->
                                <span>Incluir Filme</span> <!-- Texto isolado -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>dashboard.php" class="nav-link" id="ent-reg">Meus Filmes</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>profile.php" class="nav-link bold">
                                <?= $userData->name ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>logout.php" class="nav-link" id="ent-reg">Sair</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>auth.php" class="nav-link" id="ent-reg">Entrar/Cadastrar</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- MENSAGENS -->
    <?php if(!empty($flassMessge["msg"])): ?>
        <div class="msg-container">
            <p class="msg <?= $flassMessge["type"] ?>"><?= $flassMessge["msg"] ?></p>
        </div>
    <?php endif; ?>