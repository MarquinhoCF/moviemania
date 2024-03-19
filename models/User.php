<?php

    class User {

        public $id;
        public $name;
        public $lastname;
        public $email;
        public $password;
        public $image;
        public $bio;
        public $token;

        public function generatePassword($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }

        public function generateToken() {
            return bin2hex(random_bytes(50));
        }

    }

    interface UserDAOInterface {

        public function buildUser($data);
        public function create(User $user, $authUser = false);
        public function update(User $user);
        public function findbyToken($token);
        public function verifyToken($proteceted = false);
        public function setTokenToSession($token, $redirect = true);
        public function authenticateUser($email, $password);
        public function findByEmail($email);
        public function findById($id);
        public function destroyToken();
        public function changePassword(User $user);

    }