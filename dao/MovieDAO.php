<?php

    require_once("models/Movie.php");
    require_once("models/Message.php");
    require_once("dao/ReviewDAO.php");

    function compareMovies($movie1, $movie2) {
        if ($movie1->rating === $movie2->rating) {
            return 0;
        }
        $val1 = $movie1->rating === "Não avaliado" ? 0 : $movie1->rating;
        $val2 = $movie2->rating === "Não avaliado" ? 0 : $movie2->rating;

        return ($val1 < $val2) ? 1 : -1;
    }

    class MovieDAO implements MovieDAOInterface {
        
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildMovie($data) {

            $movie = new Movie();

            $movie->id = $data["id"];
            $movie->title = $data["title"];
            $movie->description = $data["description"];
            $movie->image = $data["image"];
            $movie->trailer = $data["trailer"];
            $movie->category = $data["category"];
            $movie->length = $data["length"];
            $movie->userID = $data["users_id"];

            // Recebe o rating do filme
            $reviewDao = new ReviewDAO($this->conn, $this->url);
            $movie->rating = $reviewDao->getRatings($data["id"]);

            return $movie;

        }

        public function getLatestMovies($qtd = null) {
            $movies = [];

            $stmt = $this->conn->query("SELECT * FROM movies ORDER BY id DESC");
            $stmt->execute();

            $moviesNumber = $stmt->rowCount();

            if ($moviesNumber > 0) {
                $moviesArray = $stmt->fetchAll();

                if (isset($qtd)) {
                    $n = $moviesNumber;
                    if ($moviesNumber > $qtd) {
                        $n = $qtd;
                    }

                    for ($i = 0; $i < $n; $i++) {
                        $movies[] = $this->buildMovie($moviesArray[$i]);
                    }
                } else {
                    foreach($moviesArray as $movie) {
                        $movies[] = $this->buildMovie($movie);
                    }
                }
            }

            return $movies;
        }

        public function getBestMovies($qtd = null) {
            $movies = [];

            $stmt = $this->conn->query("SELECT * FROM movies ORDER BY id DESC");
            $stmt->execute();

            $moviesNumber = $stmt->rowCount();

            if ($moviesNumber > 0) {
                $moviesArray = $stmt->fetchAll();

                $moviesUncliped = [];

                foreach($moviesArray as $movie) {
                    $moviesUncliped[] = $this->buildMovie($movie);
                }

                usort($moviesUncliped, 'compareMovies');

                if (isset($qtd)) {
                    $n = $moviesNumber;
                    if ($moviesNumber > $qtd) {
                        $n = $qtd;
                    }

                    for ($i = 0; $i < $n; $i++) {
                        $movies[] = $moviesUncliped[$i];
                    }
                } else {
                    return $moviesUncliped;
                }
            }

            return $movies;
        }

        public function getMoviesByCategory($category, $qtd = null) {
            $movies = [];

            $stmt = $this->conn->prepare("
                SELECT * FROM movies 
                WHERE category = :category 
                ORDER BY id DESC"
            );

            $stmt->bindParam(":category", $category);

            $stmt->execute();

            $moviesNumber = $stmt->rowCount();

            if ($moviesNumber > 0) {
                $moviesArray = $stmt->fetchAll();

                if (isset($qtd)) {
                    $n = $moviesNumber;
                    if ($moviesNumber > $qtd) {
                        $n = $qtd;
                    }

                    for ($i = 0; $i < $n; $i++) {
                        $movies[] = $this->buildMovie($moviesArray[$i]);
                    }
                } else {
                    foreach($moviesArray as $movie) {
                        $movies[] = $this->buildMovie($movie);
                    }
                }
            }

            return $movies;
        }

        public function getBestMoviesByCategory($category, $qtd = null) {
            $movies = [];

            $stmt = $this->conn->prepare("
                SELECT * FROM movies 
                WHERE category = :category 
                ORDER BY id DESC"
            );

            $stmt->bindParam(":category", $category);

            $stmt->execute();

            $moviesNumber = $stmt->rowCount();

            if ($moviesNumber > 0) {
                $moviesArray = $stmt->fetchAll();

                $moviesUncliped = [];

                foreach($moviesArray as $movie) {
                    $moviesUncliped[] = $this->buildMovie($movie);
                }

                usort($moviesUncliped, 'compareMovies');

                if (isset($qtd)) {
                    $n = $moviesNumber;
                    if ($moviesNumber > $qtd) {
                        $n = $qtd;
                    }

                    for ($i = 0; $i < $n; $i++) {
                        $movies[] = $moviesUncliped[$i];
                    }
                } else {
                    return $moviesUncliped;
                }
            }

            return $movies;
        }

        public function getMoviesByUserId($userID) {
            $movies = [];

            $stmt = $this->conn->prepare("
                SELECT * FROM movies 
                WHERE users_id = :users_id"
            );

            $stmt->bindParam(":users_id", $userID);
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $moviesArray = $stmt->fetchAll();

                foreach($moviesArray as $movie) {
                    $movies[] = $this->buildMovie($movie);
                }
            }

            return $movies;
        }

        public function findById($id) {
            $stmt = $this->conn->prepare("
                SELECT * FROM movies 
                WHERE id = :id"
            );

            $stmt->bindParam(":id", $id);
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $movieData = $stmt->fetch();

                $movie = $this->buildMovie($movieData);

                return $movie;
            } else {
                return false;
            }
        }

        public function findByTitle($title) {
            $movies = [];

            $stmt = $this->conn->prepare("
                SELECT * FROM movies 
                WHERE title LIKE :title"
            );

            $stmt->bindValue(":title", '%' . $title . '%'); 
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $moviesArray = $stmt->fetchAll();

                foreach($moviesArray as $movie) {
                    $movies[] = $this->buildMovie($movie);
                }
            }

            return $movies;
        }

        public function create(Movie $movie) {
            $stmt = $this->conn->prepare("
                INSERT INTO movies (
                    title, description, image, trailer, category, length, users_id
                ) VALUES (
                    :title, :description, :image, :trailer, :category, :length, :users_id
                )
            ");

            $stmt->bindParam(":title", $movie->title);
            $stmt->bindParam(":description", $movie->description);
            $stmt->bindParam(":image", $movie->image);
            $stmt->bindParam(":trailer", $movie->trailer);
            $stmt->bindParam(":category", $movie->category);
            $stmt->bindParam(":length", $movie->length);
            $stmt->bindParam(":users_id", $movie->userID);

            $stmt->execute();

            // Mensagem de sucesso ao adicionar filme
            $this->message->setMessage("Filme adicionado com sucesso!", "success", "index.php");
        }

        public function update(Movie $movie) {
            $stmt = $this->conn->prepare("UPDATE movies SET 
                title = :title,
                description = :description,
                image = :image,
                trailer = :trailer,
                category = :category,
                length = :length
                WHERE id = :id;
            ");

            $stmt->bindParam(":title", $movie->title);
            $stmt->bindParam(":description", $movie->description);
            $stmt->bindParam(":image", $movie->image);
            $stmt->bindParam(":trailer", $movie->trailer);
            $stmt->bindParam(":category", $movie->category);
            $stmt->bindParam(":length", $movie->length);
            $stmt->bindParam(":id", $movie->id);

            $stmt->execute();

            // Mensagem de sucesso ao deletar o filme
            $this->message->setMessage("Filme editado com sucesso!", "success", "back");
        }

        public function destroy($id) {
            $stmt = $this->conn->prepare("DELETE FROM movies WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            // Mensagem de sucesso ao deletar o filme
            $this->message->setMessage("Filme removido com sucesso!", "success", "dashboard.php");
        }

    }