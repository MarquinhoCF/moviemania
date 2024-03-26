<?php 

    require_once("templates/header.php")

?>

    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Filmes Novos</h2>
        <p class="section-description">Veja as críticas dos últimos filmes adicionados no Movie Mania</p>
        <div class="movies-container">
            <div class="card movie-card">
                <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/movies/movie_cover.jpg')"></div>
                <div class="card-body">
                    <p class="card-rating">
                        <i class="fas fa-star"></i>
                        <span class="rating">9</span>
                        <h5 class="card-title">
                            <a href="#">Título do Filme</a>
                        </h5>
                        <a href="#" class="btn btn-primary rate-btn">Avaliar</a>
                        <a href="#" class="btn btn-primary card-btn">Conhecer</a>
                    </p>
                </div>
            </div>
        </div>
        <h2 class="section-title">Ação</h2>
        <p class="section-description">Veja os melhores filmes de ação</p>
        <div class="movies-container"></div>
        <h2 class="section-title">Comédia</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container"></div>
    </div>

<?php 

    require_once("templates/footer.php")

?>