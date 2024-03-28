<?php

    require_once("templates/header.php");

    // Verifica se o usuário está logado
    require_once("models/User.php");
    require_once("models/Movie.php");
    require_once("dao/UserDAO.php");
    require_once("dao/MovieDAO.php");

    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    $movieDao = new MovieDAO($conn, $BASE_URL);

    $id = filter_input(INPUT_GET, "id");

    $movie;
    if (empty($id)) {
        $message->setMessage("O filme não foi encontrado!", "error", "index.php");
    } else {
        $movie = $movieDao->findById($id);

        // Verifica se o filme existe
        if (!$movie) {
            $message->setMessage("O filme não foi encontrado!", "error", "index.php");
        } else {
            if ($movie->userID !== $userData->id) {
                $message->setMessage("Informações inválidas!", "error", "index.php");
            }
        }
    }

    // Checar se o filme tem imagem
    if ($movie->image == "") {
        $movie->image = "movie_cover.jpg";
    }
?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1 class="edit-movie-title"><?= $movie->title ?></h1>
                <p class="page-description">Altere os dados do filme no formulário abaixo:</p>
                <form id="edit-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?= $movie->id ?>">
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Digite o título do seu filme" value="<?= $movie->title ?>">
                    </div>
                    <div class="form-group" id="image-new-movie">
                        <label for="image">Imagem:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="length">Duração:</label>
                        <input type="text" class="form-control" name="length" id="length" placeholder="Digite a duração do filme" value="<?= $movie->length ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Categoria:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Selecione</option>
                            <option value="Ação" <?= $movie->category === "Ação" ? "selected" : "" ?>>Ação</option>
                            <option value="Drama" <?= $movie->category === "Drama" ? "selected" : "" ?>>Drama</option>
                            <option value="Romance" <?= $movie->category === "Romance" ? "selected" : "" ?>>Romance</option>
                            <option value="Comédia" <?= $movie->category === "Comédia" ? "selected" : "" ?>>Comédia</option>
                            <option value="Comédia Romântica" <?= $movie->category === "Comédia Romântica" ? "selected" : "" ?>>Comédia Romântica</option>
                            <option value="Fantasia" <?= $movie->category === "Fantasia" ? "selected" : "" ?>>Fantasia</option>
                            <option value="Animação" <?= $movie->category === "Animação" ? "selected" : "" ?>>Animação</option>
                            <option value="Ficção Científica" <?= $movie->category === "Ficção Científica" ? "selected" : "" ?>>Ficção Científica</option>
                            <option value="Documentário" <?= $movie->category === "Documentário" ? "selected" : "" ?>>Documentário</option>
                            <option value="Mistério" <?= $movie->category === "Mistério" ? "selected" : "" ?>>Mistério</option>
                            <option value="Guerra" <?= $movie->category === "Guerra" ? "selected" : "" ?>>Guerra</option>
                            <option value="Faroeste" <?= $movie->category === "Faroeste" ? "selected" : "" ?>>Faroeste</option>
                            <option value="Terror" <?= $movie->category === "Terror" ? "selected" : "" ?>>Terror</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="trailer">Trailer:</label>
                        <input type="text" class="form-control" name="trailer" id="trailer" placeholder="Insira o link do trailer no Youtube" value="<?= $movie->trailer ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o filme"><?= $movie->description ?></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Editar Filme">
                </form>
            </div>
            <div class="col-md-3" id="edit-movie-image">
                <div class="movie-image-container" style="background-image : url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
            </div>
        </div>
    </div>
</div>

<?php

    require_once("templates/footer.php");

?>