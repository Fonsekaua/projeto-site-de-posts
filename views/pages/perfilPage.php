    <?php 
    $posts = selecionarTabela("posts");
    $postagens = UploadImgUserLog($id);
    $action = "pages/service/upload.php";
    $enctype = "multipart/form-data";

    ?>
    
    <fieldset id="minhas_imagens">
        <legend id="adicionar_imagem">adicionar Imagem</legend>
            <h1><?= $postagens?"My Posts": "Você ainda não possui posts, o que esta esperando ?"?></h1>
        <div id="imagens">
            <?php foreach($postagens as $post):?>  
            <div id="imagem">
            <img src="pages/service/<?= $post['url']?>">
            <p ><?= $post['descricao']?></p>
            </div>
            
            <?php endforeach?>    
         </div>
    </fieldset>

    <form  action=<?=$action?>  method="POST" enctype=<?=$enctype?>  id="post_img" class="modal">
        <h2>
            Postar nova Foto
        </h2>
        <label for="descricao">
            Descrição:
            <input type="text" id="descricao" name="descricao" required> 
        </label>
        <label for="imagem">
            Escolha uma imagem:
            <input type="file" id="arquivo" name="arquivo" placeholder="Adicione a URL da imagem...">
        </label>
        <button>
        Postar
        </button>
        <button type="button" id="cancelar">
            Cancelar
        </button>
    </form>

    <div id="modalIMG" class="modal">
    <div id="imagemMostre">
        <p id="descricaoMODAL"></p>
        <img id="imagemMODAL" src="" alt="">
    </div>
    <div id="comentarios">
        <span id="close">
            X
        </span>
        <div id="areaComentarios">
                            
        </div>

    </div>
</div>

