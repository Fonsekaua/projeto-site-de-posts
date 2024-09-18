const body = document.querySelector("body");
const form = document.querySelector("form");

const caixaError = () => {
    document.querySelector("#caixaDeInfo").classList.toggle("caixa")
}

const change = (event) => {
    event.classList.toggle("modal");
    body.classList.toggle("pagina");
}

const imagens = document.querySelector("#imagens");

const elementsArray = Array.from(imagens.children); //Necessario pra transformar uma div em array;!!
elementsArray.forEach(element => {
    const modalIMG = element.querySelector("#modalIMG");

    element.querySelector("#iComent").addEventListener("click", (e) => {
        change(modalIMG)

    })
    modalIMG.querySelector("#close").addEventListener("click", () => {
        change(modalIMG)
    })
    modalIMG.querySelector("form").addEventListener("submit", async function (event) {
        event.preventDefault()
        const conteudo = modalIMG.querySelector("input").value
        const img = modalIMG.querySelector("img")
        const usuarioID = img.getAttribute("data-userImg")
        const postID = img.getAttribute("data-id")
        console.log(usuarioID)
        try {
            const response = await axios.post("actions/api/comentarios.php", {
                conteudo: conteudo,
                usuario: usuarioID,
                post: postID
            })
            if (response.data.comente) {
                const span = document.createElement("span")
                span.innerHTML = response.data.conteudo
                modalIMG.querySelector("#areaComentarios").appendChild(span)
            }

        } catch ($err) {
            console.log("Ocorreu um erro: " + $err)
        }
    })
    element.querySelectorAll(".iconsCurtidas").forEach(icon => {
        icon.addEventListener("click", async function () {
            const usuario = this.getAttribute("data-usuario")
            const id = this.id

            try {
                const response = await axios.post("actions/api/curtidas.php", {
                    id: id,
                    usuario: usuario

                })
                console.log(response.data.mensagem)
                const i = this.querySelector(".iconsCurtidas i")
                const small = icon.querySelector("#count")
                let smallValue = parseFloat(small.innerHTML)
                if (response.data.curtida === true) {
                    i.classList.remove("fa-solid")
                    i.classList.add("fa-regular")
                     small.innerHTML = smallValue-1
                    
                } else {
                    i.classList.add("fa-solid")
                    i.classList.remove("fa-regular")
                    small.innerHTML = smallValue+1
                }
            } catch ($err) {
                console.log("Ocorreu um erro: " + $err)
            }
        })
    });
    element.querySelectorAll(".click").forEach(click => {
        click.addEventListener("click", () => {
            caixaError()
            setTimeout(caixaError, 5000);
        })
    })
});




/*
"<br />
"<br />\n<b>Fatal error</b>:  Uncaught PDOException: SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`saep`.`comentarios`, CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)) in C:\\xampp\\htdocs\\ProjetoSaep\\actions\\db_actions.php:120\nStack trace:\n#0 C:\\xampp\\htdocs\\ProjetoSaep\\actions\\db_actions.php(120): PDOStatement-&gt;execute()\n#1 C:\\xampp\\htdocs\\ProjetoSaep\\actions\\api\\comentario.php(13): comentarioUpload('aaaaaaaaaaaaaaa...', '&lt;br /&gt;\\n&lt;b&gt;Warni...', '2')\n#2 {main}\n  thrown in <b>C:\\xampp\\htdocs\\ProjetoSaep\\actions\\db_actions.php</b> on line <b>120</b><br />\n"

*/