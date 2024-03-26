<?php 

    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");

    // Dao dos filmes
    $movieDao = new MovieDAO($conn, $BASE_URL);

    $latestMovies = $movieDao->getLatestMovies();
    $actionMovies = $movieDao->getMoviesByCategory("Ação");
    $comedyMovies = $movieDao->getMoviesByCategory("Comédia");
    $fantasyMovies = $movieDao->getMoviesByCategory("Fantasia");
    $cientificFictionMovies = $movieDao->getMoviesByCategory("Ficção Científica");
    $animationMovies = $movieDao->getMoviesByCategory("Animação");
    $misteryMovies = $movieDao->getMoviesByCategory("Mistério");
    $romanceMovies = $movieDao->getMoviesByCategory("Romance");
    $farWestMovies = $movieDao->getMoviesByCategory("Faroeste")

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
        <p class="section-description">Veja os melhores filmes de ação</p>
        <div class="movies-container">
            <?php foreach($actionMovies as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($actionMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de ação cadastrados</p>
            <?php endif; ?>
        </div>
        <h2 class="section-title">Comédia</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
            <?php foreach($comedyMovies as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($comedyMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
            <?php endif; ?>
        </div>
        <h2 class="section-title">Fantasia</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
            <?php foreach($fantasyMovies as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($fantasyMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
            <?php endif; ?>
        </div>
        <h2 class="section-title">Ficção Científica</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
            <?php foreach($cientificFictionMovies as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($cientificFictionMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
            <?php endif; ?>
        </div>
        <h2 class="section-title">Animação</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
            <?php foreach($animationMovies as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($animationMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
            <?php endif; ?>
        </div>
        <h2 class="section-title">Mistério</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
            <?php foreach($misteryMovies as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($misteryMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
            <?php endif; ?>
        </div>
        <h2 class="section-title">Romance</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
            <?php foreach($romanceMovies as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($romanceMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
            <?php endif; ?>
        </div>
        <h2 class="section-title">Faroeste</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
            <?php foreach($farWestMovies as $movie): ?>
                <?php include("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($farWestMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
            <?php endif; ?>
        </div>
    </div>

<?php 

    require_once("templates/footer.php")

?>