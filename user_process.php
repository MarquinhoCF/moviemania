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

        // Receber dados do post
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        // Resgata dados do usuário
        $userData = $userDao->verifyToken();
        $id = $userData->id;

        if ($password === $confirmpassword) {
            // Verifica se a senha tem pelo menos 6 caracteres
            if (strlen($password) > 5) {
                // Verifica se há caracteres alfabético
                if (preg_match('/[a-z]/', strtolower($password))) {
                    // Verifica se há pelo menos um caractere alfabético maiúsculo e minusculo
                    if (preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password)) {
                        // Verifica se há pelo menos um número
                        if (preg_match('/\d/', $password)) {
                            // Verifica se há pelo menos um caractere especial
                            if (preg_match('/[!@#$%^&*()_+=\-[\]{};:\'"\\|,.<>\/?]/', $password)) {
                                
                                // Criar uma nova instância de User
                                $user = new User();

                                $finalPassword = $user->generatePassword($password);

                                $user->id = $id;
                                $user->password = $finalPassword;

                                $userDao->changePassword($user);

                            } else {
                                $message->setMessage("A senha deve conter pelo menos 1 caracter especial.", "error", "back");
                            }
                        } else {
                            $message->setMessage("A senha deve conter pelo menos 1 número.", "error", "back");
                        }
                    } else {
                        $message->setMessage("A senha deve conter pelo menos 1 caracter maiúsculo e minúsculo.", "error", "back");
                    }
                } else {
                    $message->setMessage("A senha deve conter caracteres alfabéticos.", "error", "back");
                }
            } else {
                $message->setMessage("A senha deve conter pelo menos 6 caracteres.", "error", "back");
            }
        } else {
            $message->setMessage("As senhas não são iguais.", "error", "back");
        }

    } else {
        $message->setMessage("Informações inválidas.", "error", "index.php");
    }