    <footer id="footer">
        <div id="social-container">
            <ul>
                <li>
                    <a href="https://www.facebook.com/marquinho.cferreira"><i class="fab fa-facebook-square"></i></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/marquinho_cf/"><i class="fab fa-instagram"></i></a>
                </li>
                <li>
                    <a href="https://www.youtube.com/channel/UC-XOg0t3Ax_lFiPVWN4p48Q"><i class="fab fa-youtube"></i></a>
                </li>
            </ul>
        </div>
        <div id="footer-links-container">
            <ul>
                <li><a href="<?= $BASE_URL ?>movielist.php">Melhores filmes</a></li>
                <?php if($userData): ?>
                    <li><a href="<?= $BASE_URL ?>newmovie.php">Adicionar Filmes</a></li>
                    <li>
                        <a href="<?= $BASE_URL ?>profile.php" class="nav-link bold">
                                <?= $userData->name ?>
                        </a>
                    </li>
                    <li><a href="<?= $BASE_URL ?>logout.php" class="nav-link" id="ent-reg">Sair</a></li>
                <?php else: ?>
                    <li><a href="<?= $BASE_URL ?>auth.php" class="nav-link" id="ent-reg">Entrar / Cadastrar</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <p>Copyright &copy; 2024 Movie Mania</p>
        <p>Powered by Marcos Carvalho Ferreira</p>
    </footer>
    <!-- BOTSTRAP JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.js" integrity="sha512-lsA4IzLaXH0A+uH6JQTuz6DbhqxmVygrWv1CpC/s5vGyMqlnP0y+RYt65vKxbaVq+H6OzbbRtxzf+Zbj20alGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>