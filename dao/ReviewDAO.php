<?php

    require_once("models/Review.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    class ReviewDAO implements ReviewDAOInterface {
        
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildReview($data) {

            $newReview = new Review();

            $newReview->rating = $data["rating"];
            $newReview->review = $data["review"];
            $newReview->users_id = $data["users_id"];
            $newReview->movies_id = $data["movies_id"];

            return $newReview;
        }

        public function create(Review $review) {
            $stmt = $this->conn->prepare("INSERT INTO reviews(
                    rating, review, movies_id, users_id
                ) VALUES (
                    :rating, :review, :movies_id, :users_id
                )");

            $stmt->bindParam(":rating", $review->rating);
            $stmt->bindParam(":review", $review->review);
            $stmt->bindParam(":movies_id", $review->movies_id);
            $stmt->bindParam(":users_id", $review->users_id);

            $stmt->execute();
            
            // Sucesso e redirecionamento
            $this->message->setMessage("Crítica adicionada com sucesso!", "success", "back");
        }

        public function getMoviesReview($id) {

        }

        public function hasAlreadyReviewed($id, $userID) {

        }

        public function getRatings($id) {

        }

    }