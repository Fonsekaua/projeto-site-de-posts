<?php
$posts = selecionarTabela("posts");
$curtidas = selecionarTabela("curtidas");
$comentarios = selecionarTabela("comentarios");
$action = "pages/service/upload.php";
$enctype = "multipart/form-data";

?>

<aside id="caixaDeInfo" class="caixa">
    <h2 id="title">
        sem login
    </h2>
    <p id="info">
        Faça login para poder dar like em seus posts favoritos
    </p>
</aside>

<fieldset id="minhas_imagens">
    <legend id="">Home</legend>
    <h1>Imagens Postadas</h1>
    <div id="imagens">
        <?php foreach ($posts as $post):
            // Verifica se o usuário está logado para checar curtidas
            if ($_SESSION) {
                $verificarCurtida = verificarCurtida($post['id'], $id);

            }
            $contarCurtida = contarCurtidas($post['id']);
            ?>

            <div id="imagem">
                <img data-userImg="<?= $id ?>" src="views/pages/service/<?= $post['url'] ?>" data-id="<?= $post['id'] ?>">
                <div id="icons">
                    <a class="<?= $_SESSION ? "iconsCurtidas" : "click" ?>" id="<?= $post['id'] ?>"
                        data-usuario="<?= $_SESSION ? $id : "" ?>">
                        <i class="<?= $verificarCurtida ? "fa-solid" : "fa-regular" ?> fa-heart"></i>
                        <small id="count"> <?= $contarCurtida ?></small>
                    </a>
                    <i id="iComent" class="fa-regular fa-comment"></i>
                </div>

                <div id="comentariosZone" class="itensNone">


                </div>
                <div id="modalIMG" class="modal">
                    <div id="imagemMostre">
                    <p id="describle"><?= $post['descricao'] ?></p>
                        <img data-userImg="<?= $id ?>" src="views/pages/service/<?= $post['url'] ?>"
                            data-id="<?= $post['id'] ?>">

                    </div>
                    <div id="comentarios">
                        <span id="close">
                            X
                        </span>
                        <div id="areaComentarios">
                            <?php foreach ($comentarios as $comentario):
                                $verificarComentario = verificarComentario($comentario["id"], $post['id'], $post['usuario_id']) ?>
                                <?php if ($verificarComentario): ?>
                                    <span class="paragrafo" id="<?= $comentario['post_id'] ?>">
                                        <small id="userNameSmall">
                                            <?= $_SESSION ? $usuarioLog : "" ?>
                                        </small>
                                        <?= $comentario['conteudo'] ?>
                                        
                                    </span>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <form id="formComentario">
                            <?php if ($_SESSION): ?>
                                <input id="comentario" type="text" placeholder="Comente sobre a foto">
                                <button id="comente">
                                    comente
                                </button>
                            <?php else: ?>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</fieldset>