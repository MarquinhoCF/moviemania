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

   if ($type === "register") {
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        //Verificação do dados mínimos
        if ($name && $lastname && $email && $password) {
            // Verificar as senhas batem
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
                                    
                                    // Verificar se o email já foi cadastrado
                                    if ($userDao->findByEmail($email) === false) {
                                        $user = new User();

                                        // Criação de token e senha
                                        $userToken = $user->generateToken();
                                        $finalPassword = $user->generatePassword($password);

                                        $user->name = $name;
                                        $user->lastname = $lastname;
                                        $user->email = $email;
                                        $user->password = $finalPassword;
                                        $user->token = $userToken;

                                        $auth = true;
                                        $userDao->create($user, $auth);
                                    } else {
                                        $message->setMessage("Usuário já cadastrado tente outro e-mail.", "error", "back");
                                    }


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
            // Mensagem de erro por ausência 
            $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
        }
   } else if ($type === "login") {

   }