<?php 


?>

<header>
    <h2><a href="<?= baseUrl("index.php"); ?>">Home</a></h2>

    <nav id="nav_header">
        <ul>
            <?php if($_SESSION):?>
            <li>
                <a><?= $_SESSION['usuario']?></a>
            </li>
            <li>
                <a href=<?= baseUrl("views/perfil.php") . "?id=" . $id?>>Perfil</a>
            </li>
            <li>
                <a href="<?= baseUrl("actions/api/sessionDestroi.php")?>">Sair</a>
            </li>
                 <?php else:?>
            <li>
              <a href="<?= baseUrl("views/login.php")?>">Login</a>
            </li>
            <li>
            <a href="<?= baseUrl("views/register.php")?>">Registro</a>
            </li>

                    <?php endif?>
        </ul>
    </nav>
    <div id="mobile" onclick="mostre()">
    <div class="linha"></div>
    <div class="linha"></div>
    <div class="linha"></div>
    </div>
</header>
