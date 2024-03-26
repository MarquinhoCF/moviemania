<?php 

    require_once("templates/header.php");

    // Verifica se o usuário está autenticado
    require_once("dao/UserDAO.php");
    require_once("models/User.php");

    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

?>

    <div id="main-container" class="container-fluid">
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Adicionar Filme</h1>
            <p class="page-description">Adicione sua crítica e compartilhe com o mundo</p>
            <form action="<?= $BASE_URL ?>movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Digite o título do seu filme">
                </div>
                <div class="form-group">
                    <label for="image">Imagem:</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="length">Duração:</label>
                    <input type="text" class="form-control" name="length" id="length" placeholder="Digite a duração do filme">
                </div>
                <div class="form-group">
                    <label for="category">Categoria:</label>
                    <select name="category" id="category" class="form-control">
                        <option value="Ação">Ação</option>
                        <option value="Drama">Drama</option>
                        <option value="Romance">Romance</option>
                        <option value="Comédia">Comédia</option>
                        <option value="Comédia Romântica">Comédia Romântica</option>
                        <option value="Fantasia">Fantasia</option>
                        <option value="Animação">Animação</option>
                        <option value="Ficção Científica">Ficção Científica</option>
                        <option value="Documentário">Documentário</option>
                        <option value="Mistério">Mistério</option>
                        <option value="Guerra">Guerra</option>
                        <option value="Faroeste">Faroeste</option>
                        <option value="Terror">Terror</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trailer">Trailer:</label>
                    <input type="text" class="form-control" name="trailer" id="trailer" placeholder="Insira o link do trailer">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o filme"></textarea>
                </div>
                <input type="submit" class="btn card-btn" value="Adicionar Filme">
            </form>
        </div>
    </div>

<?php 

    require_once("templates/footer.php");

?>