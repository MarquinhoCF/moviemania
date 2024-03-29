<?php 

    require_once("templates/header.php");

    // Verifica se o usuário está autenticado
    require_once("models/Movie.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/ReviewDAO.php");

    // Pegar o id do filme
    $id = filter_input(INPUT_GET, "id");

    $movie;

    $movieDao = new MovieDAO($conn, $BASE_URL);
    $reviewDao = new ReviewDAO($conn, $BASE_URL);

    if (!empty($id)) {
        $movie = $movieDao->findById($id);

        // Verifica se o filme existe
        if (!$movie) {
            $message->setMessage("O filme não foi encontrado!", "error", "index.php");
        }
        
    } else {
        $message->setMessage("O filme não foi encontrado!", "error", "index.php");
    }

    // Checar se o filme tem imagem
    if ($movie->image == "") {
        $movie->image = "movie_cover.jpg";
    }

    // Checar do filme do próprio usuário
    $userOwnsMovie = false;
    if (!empty($userData)) {
        if ($userData->id === $movie->userID) {
            $userOwnsMovie = true;
        }

        // Vendo se o usuário já avaliou esse filme
        $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);

        $unAuthenticatedUser = false;
    } else {
        $unAuthenticatedUser = true;
    }

    // Resgatar as reviews do filme
    $movieReviews = $reviewDao->getMoviesReview($id);
?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title"><?= $movie->title ?></h1>
            <p class="movie-details">
                <span>Duração: <?= $movie->length ?></span>
                <span class="pipe"></span>
                <span>Categoria: <?= $movie->category ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i> <?= $movie->rating ?></span>
            </p>
            <iframe src="<?= $movie->trailer ?>" width="560" height="315" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; 
            picture-in-picture" allowfullscreen></iframe>
            <p class="movie-description"><?= $movie->description ?></p>
        </div>
        <div class="col-md-4">
            <div class="movie-image-container" style="background-image : url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <?php if ($unAuthenticatedUser): ?>
                <div class="col-md-12 text-center" id="unauthenticated-user-call">
                    <h4>Faça o <span class="red">login</span> ou <span class="red">cadastre-se</span> já!</h4>
                    <p class="section-description">Para adicionar sua crítica à <span class="bold"><?= $movie->title ?></span></p>
                    <a href="<?= $BASE_URL ?>auth.php" class="btn card-btn">
                    <i class="fas fa-plus"></i><i class="fas fa-user"></i>  Entrar/Cadastrar
                    </a>
                </div>
            <?php endif; ?>
            <h3 class="reviews-title">Avaliações</h3>
            <!-- Verifica se habilita a review para o usuário -->
            <?php if (!empty($userData) && !$userOwnsMovie && !$alreadyReviewed): ?>
                <div class="col-md-12" id="review-form-container">
                    <h4>Envie sua avaliação</h4>
                    <p class="page-description">Preencha o formulário com a nota e o comentário do filme</p>
                    <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
                        <input type="hidden" name="type" value="create">
                        <input type="hidden" name="movies_id" value="<?= $movie->id ?>">
                        <div class="form-group">
                            <label for="rating">Nota do Filme:</label>
                            <select name="rating" id="rating" class="form-control">
                                <option value="">Selecione</option>
                                <option value="10">10</option>
                                <option value="9">9</option>
                                <option value="8">8</option>
                                <option value="7">7</option>
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="review">Seu comentário:</label>
                            <textarea name="review" id="review" class="form-control" rows="3" placeholder="O que você achou do filme?"></textarea>
                        </div>
                        <input type="submit" class="btn form-btn" value="Enviar comentário">
                    </form>
                </div>
            <?php endif; ?>
            <!-- Comentário -->
            <?php foreach($movieReviews as $review): ?>
                <?php include("templates/user_review.php"); ?>
            <?php endforeach; ?>
            <?php if (count($movieReviews) === 0): ?>
                <p class="empty-list">Não há comentários para esse filme ainda...</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php

    require_once("templates/footer.php");

?>