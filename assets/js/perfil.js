const body = document.querySelector("body");
const form = document.querySelector("form");
const modalIMG = document.getElementById("modalIMG");




const change = (event) => {
    event.classList.toggle("modal");
    body.classList.toggle("pagina");
}

document.getElementById("adicionar_imagem").addEventListener("click", () => {
    change(form);
});

document.getElementById("cancelar").addEventListener("click", () => {
    change(form);
});
     
const imagens = document.querySelector("#imagens");

const elementsArray = Array.from(imagens.children); //Necessario pra transformar uma div em array;!!
elementsArray.forEach(element => {
    element.addEventListener("click",()=>{
            const descricao = element.querySelector("p")
            const image = element.querySelector("img")
            const id = element.id
            console.log(id)

            const imagemMODAL = document.querySelector("#imagemMODAL")
            const descricaoMODAL = document.querySelector("#descricaoMODAL")

            
            imagemMODAL.src = image.src 
            descricaoMODAL.innerHTML = descricao.innerText
            change(modalIMG)

    })
});
modalIMG.addEventListener("click",()=>{
    change(modalIMG)
})