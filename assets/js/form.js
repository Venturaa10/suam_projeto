
// Função para aplicar a máscara no CPF
function formatCPF(cpf) {
    cpf = cpf.replace(/\D/g, ''); // Remove qualquer coisa que não seja número
    cpf = cpf.replace(/^(\d{3})(\d)/, '$1.$2'); // Aplica o primeiro ponto
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Aplica o segundo ponto
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Aplica o traço
    
    return cpf;
    }

    // Adiciona a máscara ao campo CPF enquanto o usuário digita
    document.getElementById('cpf').addEventListener('input', function (e) {
    e.target.value = formatCPF(e.target.value);
    });
    

document.addEventListener("DOMContentLoaded", function () {
    // Função que adicionar transição na mensagem de erro do formulario.
    
    const errorMessages = document.querySelectorAll(".msg-error-form");

    errorMessages.forEach((msg) => {
        // Adiciona a classe para exibir com transição
        msg.classList.add("show-error");

        // Remove a mensagem após 4 segundos
        setTimeout(() => {
            msg.classList.remove("show-error");
            setTimeout(() => msg.style.display = "none", 500); // Aguarda a transição para esconder
        }, 4000); 
    });
});
