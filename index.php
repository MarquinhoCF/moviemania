<?php 

    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");

    // Dao dos filmes
    $movieDao = new MovieDAO($conn, $BASE_URL);

    $latestMovies = $movieDao->getLatestMovies(10);
    $actionMovies = $movieDao->getBestMoviesByCategory("Ação", 5);
    $comedyMovies = $movieDao->getBestMoviesByCategory("Comédia", 5);
    $fantasyMovies = $movieDao->getBestMoviesByCategory("Fantasia", 5);
    $cientificFictionMovies = $movieDao->getBestMoviesByCategory("Ficção Científica", 5);
    $animationMovies = $movieDao->getBestMoviesByCategory("Animação", 5);
    $misteryMovies = $movieDao->getBestMoviesByCategory("Mistério", 5);
    $romanceMovies = $movieDao->getBestMoviesByCategory("Romance", 5);
    $farWestMovies = $movieDao->getBestMoviesByCategory("Faroeste", 5);
    $romanceComedyMovies = $movieDao->getBestMoviesByCategory("Comédia Romântica", 5);
    $warMovies = $movieDao->getBestMoviesByCategory("Guerra", 5);
    $dramaticMovies = $movieDao->getBestMoviesByCategory("Drama", 5);
    $horrorMovies = $movieDao->getBestMoviesByCategory("Terror", 5);
    $documentaryMovies = $movieDao->getBestMoviesByCategory("Documentário", 5);

?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes Novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no Movie Mania</p>
    <div class="movies-container">
        <?php foreach($latestMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($latestMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação<br><a href="<?= $BASE_URL ?>movielist.php?category=Ação">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($actionMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($actionMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de ação cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia<br><a href="<?= $BASE_URL ?>movielist.php?category=Comédia">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($comedyMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($comedyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Fantasia</h2>
    <p class="section-description">Veja os melhores filmes de fantasia<br><a href="<?= $BASE_URL ?>movielist.php?category=Fantasia">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($fantasyMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($fantasyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de fantasia cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Ficção Científica</h2>
    <p class="section-description">Veja os melhores filmes de ficção científica<br><a href="<?= $BASE_URL ?>movielist.php?category=Ficção Científica">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($cientificFictionMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($cientificFictionMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de ficção científica cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Animação</h2>
    <p class="section-description">Veja os melhores filmes de animação<br><a href="<?= $BASE_URL ?>movielist.php?category=Animação">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($animationMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($animationMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de animação cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Mistério</h2>
    <p class="section-description">Veja os melhores filmes de mistério<br><a href="<?= $BASE_URL ?>movielist.php?category=Mistério">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($misteryMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($misteryMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de mistério cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Drama</h2>
    <p class="section-description">Veja os melhores filmes de drama<br><a href="<?= $BASE_URL ?>movielist.php?category=Drama">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($dramaticMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($dramaticMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de drama cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Romance</h2>
    <p class="section-description">Veja os melhores filmes de romance<br><a href="<?= $BASE_URL ?>movielist.php?category=Romance">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($romanceMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($romanceMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de romance cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Comédia Romântica</h2>
    <p class="section-description">Veja os melhores filmes de comédia romântica<br><a href="<?= $BASE_URL ?>movielist.php?category=Comédia Romântica">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($romanceComedyMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($romanceComedyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de comédia romântica cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Guerra</h2>
    <p class="section-description">Veja os melhores filmes de guerra<br><a href="<?= $BASE_URL ?>movielist.php?category=Guerra">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($warMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($warMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de guerra cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Faroeste</h2>
    <p class="section-description">Veja os melhores filmes de faroeste<br><a href="<?= $BASE_URL ?>movielist.php?category=Faroeste">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($farWestMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($farWestMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de faroeste cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Terror</h2>
    <p class="section-description">Veja os melhores filmes de terror<br><a href="<?= $BASE_URL ?>movielist.php?category=Terror">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($horrorMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($horrorMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de terror cadastrados</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Documentário</h2>
    <p class="section-description">Veja os melhores filmes de documentário<br><a href="<?= $BASE_URL ?>movielist.php?category=Documentário">Ver mais</a></p>
    <div class="movies-container">
        <?php foreach($documentaryMovies as $movie): ?>
            <?php include("templates/movie_card.php"); ?>
        <?php endforeach; ?>
        <?php if (count($documentaryMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de documentário cadastrados</p>
        <?php endif; ?>
    </div>
</div>

<?php 

    require_once("templates/footer.php")

?>