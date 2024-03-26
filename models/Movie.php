<?php

    class Movie {

        public $id;
        public $title;
        public $description;
        public $image;
        public $trailer;
        public $category;
        public $length;
        public $userID;

    }

    interface MovieDAOInterface {

        public function buildMovie($data);
        public function findAll();
        public function getLatestMovies();
        public function getMoviesByCategory($category);
        public function getMoviesByUserId($userID);
        public function findById($id);
        public function findByTitle($title);
        public function create(Movie $movie);
        public function update(Movie $movie);
        public function destroy($id);
        
    }