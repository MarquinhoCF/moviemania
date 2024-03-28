<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Movie.php");
    require_once("models/Message.php");
    require_once("models/ImageUtils.php");
    require_once("dao/UserDAO.php");
    require_once("dao/MovieDAO.php");

    $message = new Message($BASE_URL);

    $userDao = new UserDAO($conn, $BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);

    // Resgata dados do usuário
    $userData = $userDao->verifyToken();

    // Resgata o tipo do formulário
    $type = filter_input(INPUT_POST, "type");

    if ($type === "create") {
        
    }