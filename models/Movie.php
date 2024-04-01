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
        public $rating;

    }

    interface MovieDAOInterface {

        public function buildMovie($data);
        public function getLatestMovies($qtd = null);
        public function getBestMovies($qtd = null);
        public function getMoviesByCategory($category, $qtd = null);
        public function getBestMoviesByCategory($category, $qtd = null);
        public function getMoviesByUserId($userID);
        public function findById($id);
        public function findByTitle($title);
        public function create(Movie $movie);
        public function update(Movie $movie);
        public function destroy($id);
        
    }