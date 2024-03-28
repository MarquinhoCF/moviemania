<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Movie.php");
    require_once("models/Message.php");
    require_once("models/Review.php");
    require_once("models/ImageUtils.php");
    require_once("dao/UserDAO.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/ReviewDAO.php");

    $message = new Message($BASE_URL);

    $userDao = new UserDAO($conn, $BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);
    $reviewDao = new ReviewDAO($conn, $BASE_URL);

    // Resgata dados do usuário
    $userData = $userDao->verifyToken();

    // Resgata o tipo do formulário
    $type = filter_input(INPUT_POST, "type");

    if ($type === "create") {

        // Recebendo dados do post
        $rating = filter_input(INPUT_POST, "rating");
        $review = filter_input(INPUT_POST, "review");
        $movies_id = filter_input(INPUT_POST, "movies_id");

        $newReview = new Review();

        $movieData = $movieDao->findById($movies_id);

        if ($movieData) {
            // Verificar dados mínimos
            if (!empty($rating) && !empty($review) && !empty($movies_id)) {
                $newReview->rating = $rating;
                $newReview->review = $review;
                $newReview->movies_id = $movies_id;
                $newReview->users_id = $userData->id;

                $reviewDao->create($newReview);
                
            } else {
                $message->setMessage("Você precisa adicionar nota e comentário para fazer a avalição!", "error", "back");
            }
        } else {
            $message->setMessage("Informaões inválidas!", "error", "index.php");
        }
    } else {
        $message->setMessage("Informaões inválidas!", "error", "index.php");
    }