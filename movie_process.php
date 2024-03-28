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

        // Receber os dados dos inputs
        $title = filter_input(INPUT_POST, "title");
        $description = filter_input(INPUT_POST, "description");
        $trailer = filter_input(INPUT_POST, "trailer");
        $category = filter_input(INPUT_POST, "category");
        $length = filter_input(INPUT_POST, "length");

        $movie = new Movie();

        // Validação de dados
        if (!empty($title) && !empty($description) && !empty($category)) {
            $errorSendTrailer = false;
            $errorSendImage = false;

            $movie->title = $title;
            $movie->description = $description;
            $movie->category = $category;
            $movie->length = $length;
            $movie->userID = $userData->id;

            // Verificando se o link passado é um link de um vídeo no youtube
            if (!empty($trailer)) {
                // Padrão de expressão regular para verificar se a string é um link do YouTube Embed
                $pattern = '/^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/(embed|v)\/.+/';

                // Verifica se a string corresponde ao padrão
                if (preg_match($pattern, $trailer)) {
                    $movie->trailer = $trailer;
                } else {
                    $errorSendTrailer = true;
                }
            }

            // Upload de imagem do filme
            if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
                $img = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArrays = ["image/jpeg", "image/jpg"];
    
                // Checagem de tipo de imagem
                if(in_array($img["type"], $imageTypes)) {
                    // Imagem é jpg
                    if (in_array($img["type"], $jpgArrays)) {
                        $imageFile = imagecreatefromjpeg($img["tmp_name"]);
                    // Imagem é png
                    } else {
                        $imageFile = imagecreatefrompng($img["tmp_name"]);
                    }
    
                    $imageName = ImageUtils::imageGenerateName($img["tmp_name"]);
                    imageJpeg($imageFile, "./img/movies/" . $imageName, 100);
                    $movie->image = $imageName;
                } else {
                    $errorSendImage = true;
                }
            }

            if ($errorSendTrailer) {
                $message->setMessage("Link de trailer inválido, insira o link de um vídeo embed do youtube! Dica: abra o trailer de sua escolha no youtube clique no botão compartilhar e depois no botão incorporar, copie o link e cole. Exemplo: https://www.youtube.com/embed/rsQEor4y2hg?si=6ed2RgXTWjonZap5", "error", "back");
            } else if ($errorSendImage) {
                $message->setMessage("Tipo inválido de imagem. Insira png ou jpg!", "error", "back");
            } else {
                $movieDao->create($movie);
            }

        } else {
            $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");
        }
    
    // Confirma exclusão de filme
    } else if ($type === "delete") {

        // Recebe os dados do form
        $id = filter_input(INPUT_POST, "id");

        $movie = $movieDao->findById($id);


        if ($movie) {
            
            if ($movie->userID === $userData->id) {

                $movieDao->destroy($movie->id);

            } else {
                $message->setMessage("Informações inválidas.", "error", "index.php");
            }

        } else {
            $message->setMessage("Informações inválidas.", "error", "index.php");
        }

    } else {
        $message->setMessage("Informações inválidas.", "error", "index.php");
    }