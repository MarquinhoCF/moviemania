<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $userDao = new UserDAO($conn, $BASE_URL);

    // Resgata o tipo do formulário
    $type = filter_input(INPUT_POST, "type");

    // Atualizar usuário
    if ($type === "update") {
        
        // Resgata dados do usuário
        $userData = $userDao->verifyToken();

        // Receber dados do post
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $bio = filter_input(INPUT_POST, "bio");

        // Criando novo objeto de Usuário
        $user = new User();

        // Alterando os dados de Usuário
        $userData->name = $name;
        $userData->lastname = $lastname;
        $userData->email = $email;
        $userData->bio = $bio;

        // Upload imagem
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

                $imageName = $user->imageGenerateName($img["tmp_name"]);
                imageJpeg($imageFile, "./img/users/" . $imageName, 100);
                $userData->image = $imageName;
            } else {
                $message->setMessage("Tipo inválido de imagem. Insira png ou jpg!", "error", "back");
            }
        }

        $userDao->update($userData);

    // Atualizar semha de usuário
    } else if ($type === "changepassword") {

    } else {
        $message->setMessage("Informações inválidas.", "error", "index.php");
    }