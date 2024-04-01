<?php 

    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");

    // Dao dos filmes
    $movieDao = new MovieDAO($conn, $BASE_URL);

    $category = filter_input(INPUT_GET, "category");

    $moviesArray = [];
    
    if (isset($category)) {
        $moviesArray = $movieDao->getMoviesByCategory($category);
    } else {
        $moviesArray = $movieDao->getBestMovies();
    }

?>

<div id="main-container" class="container-fluid">
    <?php if (!isset($category)): ?>
        <h2 class="section-title">Melhores filmes:</h2>
        <p class="section-description">Veja os filmes mais bem avaliados do Movie Mania</p>
        <div class="movies-container">
            <?php foreach($moviesArray as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($moviesArray) === 0): ?>
                <p class="empty-list" id="category-empty-list">Ainda não há filmes de <?= strtolower($category) ?> cadastrados</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <h2 class="section-title">Categoria: <span id="category-selected"><?= $category ?></span></h2>
        <p class="section-description">Veja todos os filmes de <?= strtolower($category) ?> adicionados no Movie Mania</p>
        <div class="movies-container">
            <?php foreach($moviesArray as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($moviesArray) === 0): ?>
                <p class="empty-list" id="category-empty-list">Ainda não há filmes de <?= strtolower($category) ?> cadastrados</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php 

    require_once("templates/footer.php")

?>