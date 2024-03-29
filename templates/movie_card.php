<?php
    if ($movie->image == "") {
        $movie->image = "movie_cover.jpg";
    }
?>
<div class="card movie-card">
    <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>">
        <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
    </a>
    <div class="card-body">
        <p class="card-rating">
            <i class="fas fa-star"></i> <span class="rating"><?= $movie->rating ?></span>
            <h5 class="card-title">
                <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>"><?= $movie->title ?></a>
            </h5>
            <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary rate-btn">Avaliar</a>
            <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary card-btn">Conhecer</a>
        </p>
    </div>
</div>