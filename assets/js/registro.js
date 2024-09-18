const button = document.querySelector("button");
button.addEventListener("click", async function(event){
    event.preventDefault(); // Impede o envio padrão do formulário

    // Acessa o formulário ou o container apropriado
    const form = document.querySelector("form");
    const nome = form.querySelector("#nome").value;
    const usuario = form.querySelector("#usuario").value;
    const email = form.querySelector("#email").value;
    const senha = form.querySelector("#senha").value;

    try {
            const response = await axios.post("../actions/api/registro.php", {
                nome: nome,
                usuario: usuario,
                email: email,
                senha: senha
            });
            const verifiqueResponse = response.data.registro;
            const mensagem = response.data.mensagem 
            const caixaError = () =>{
                document.querySelector("#title").innerHTML = "Error"
                document.querySelector("#info").innerHTML = mensagem
                document.querySelector("#caixaDeInfo").classList.toggle("caixa")
                }

            if(verifiqueResponse){
                window.location.href = 'http://localhost/ProjetoSaep/views/login.php';
            }else{
                caixaError()
                setTimeout(caixaError, 5000);  
            }
    } catch (err) {
        console.log("Ocorreu um erro: " + err);
    }
});
