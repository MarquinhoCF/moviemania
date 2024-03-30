<?php 

    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");

    // Dao dos filmes
    $movieDao = new MovieDAO($conn, $BASE_URL);

    $category = filter_input(INPUT_GET, "category");

    $categoryMovies = $movieDao->getMoviesByCategory($category);

?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Categoria: <span id="category-selected"><?= $category ?></span></h2>
    <p class="section-description">Veja todos os filmes de <?= strtolower($category) ?> adicionado no Movie Mania</p>
    <div class="movies-container">
        <?php foreach($categoryMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($categoryMovies) === 0): ?>
            <p class="empty-list" id="category-empty-list">Ainda não há filmes de <?= strtolower($category) ?> cadastrados</p>
        <?php endif; ?>
    </div>
</div>

<?php 

    require_once("templates/footer.php")

?>