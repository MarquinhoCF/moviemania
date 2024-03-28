<?php

    require_once("templates/header.php");

    // Verificando se o usuário está autenticado
    require_once("dao/UserDAO.php");
    require_once("models/User.php");

    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    $type = filter_input(INPUT_POST, "type");

    if ($type !== "confirm delete") {
        $message->setMessage("Informações inválidas.", "error", "index.php");
    } else {
        // Pegar o id e o título do filme
        $id = filter_input(INPUT_POST, "id");
        $title = filter_input(INPUT_POST, "title");

        if (!isset($id) || !isset($title)) {
            $message->setMessage("Informações inválidas.", "error", "index.php");
        }
    }

?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 text-center mt-5 delete-movie-container">
        <h2 class="confirm-title">Confirmação</h2>
        <p class="confirm-description">
            Você tem certeza que deseja excluir o filme <span class="bold"><?= $title ?></span>?
        </p>
        <div class="confirm-actions">
            <a href="<?= $BASE_URL ?>dashboard.php" class="cancel-btn">
                <i class="fas fa-check"></i> Manter
            </a>
            <form action="<?= $BASE_URL ?>movie_process.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" class="delete-btn">
                    <i class="fas fa-times"></i> Deletar
                </button>
            </form>
        </div>
    </div>
</div>

<?php

    require_once("templates/footer.php");

?>