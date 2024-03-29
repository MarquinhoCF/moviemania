<?php

    require_once("models/Review.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    class ReviewDAO implements ReviewDAOInterface {
        
        private $conn;
        private $url;
        private $message;
        private $userDao;

        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
            $this->userDao = new UserDAO($conn, $url);
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
            $reviews = [];

            $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movies_id");

            $stmt->bindParam(":movies_id", $id);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $reviewsData = $stmt->fetchAll();

                foreach($reviewsData as $reviewData) {
                    $review = $this->buildReview($reviewData);

                    // Chamar os dados do usuário
                    $user = $this->userDao->findById($review->users_id);
                    $review->user = $user;

                    $reviews[] = $review;
                }
            }
            
            return $reviews;
        }

        public function hasAlreadyReviewed($id, $userID) {
            $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movies_id AND users_id = :users_id;");

            $stmt->bindParam(":movies_id", $id);
            $stmt->bindParam(":users_id", $userID);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getRatings($id) {
            $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movies_id;");

            $stmt->bindParam(":movies_id", $id);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $rating = 0;
                $reviews = $stmt->fetchAll();

                foreach($reviews as $review) {
                    $rating += $review["rating"];
                }

                $rating = $rating / count($reviews);
            } else {
                $rating = "Não avaliado";
            }

            return $rating;
        }

    }