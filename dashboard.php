<?php 

    require_once("templates/header.php");

    // Verificando se o usuário está autenticado
    require_once("dao/UserDAO.php");
    require_once("models/User.php");

    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashborad</h2>
    <p class="section-description">Atualize as informações dos filmes que você enviou</p>
    <div class="col-md-12" id="add-movie-container">
        <a href="<?= $BASE_URL ?>newmovie.php" class="btn form-btn">
            <i class="fas fa-plus"></i> Adicionar Filme
        </a>
    </div>
    <div class="col-md-12" id="movies-dashboard">
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Nota</th>
                <th scope="col" class="actions-column">Ações</th>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td>
                        <a href="#" class="table-movie-title">Título</a>
                    </td>
                    <td>
                        <i class="fas fa-star"></i> 9
                    </td>
                    <td class="actions-column">
                        <a href="" class="edit-btn">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="">
                            <button type="submit" class="delete-btn">
                                <i class="fas fa-times"></i> Deletar
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php 

    require_once("templates/footer.php");

?>