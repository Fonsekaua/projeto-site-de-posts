const button = document.querySelector("button");
button.addEventListener("click", async function(event){
    event.preventDefault();
    // Acessa o formulário ou o container apropriado
    const form = document.querySelector("form");
    const usuario = form.querySelector("#usuario").value;
    const email = form.querySelector("#email").value;
    const senha = form.querySelector("#senha").value;

    try {
            const response = await axios.post("../actions/api/login.php", {
                usuario: usuario,
                email: email,
                senha: senha
            });
            const verifiqueResponse = response.data.login;
            const mensagem = response.data.mensagem 
            const caixaError = () =>{
                document.querySelector("#title").innerHTML = "Error"
                document.querySelector("#info").innerHTML = mensagem
                document.querySelector("#caixaDeInfo").classList.toggle("caixa")
                }
  
            if(verifiqueResponse){
                
                const session = await axios.post("../actions/api/session.php", {
                    usuario: usuario,
                    
                });
                window.location.href = 'http://localhost/ProjetoSaep/';
                
            }else{
                caixaError()
                setTimeout(caixaError, 5000);
 

            }
            console.log(response.data.mensagem) 
    } catch (err) {
        console.log("Ocorreu um erro: " + err);
    }
});
