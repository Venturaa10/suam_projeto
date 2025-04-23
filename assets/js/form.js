
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
        // Função que adiciona transição na mensagem de erro do formulário
        function showErrorMessages() {
            const errorMessages = document.querySelectorAll(".msg-error-form");
    
            errorMessages.forEach((msg) => {
                // Torna a mensagem visível
                msg.style.display = "block";
                setTimeout(() => msg.classList.add("show-error"), 50); // Pequeno delay para animação
    
                // Remove a mensagem após 4 segundos
                setTimeout(() => {
                    msg.classList.remove("show-error");
                    setTimeout(() => msg.style.display = "none", 500); // Aguarda a transição para esconder
                }, 4000);
            });
        }
    
        showErrorMessages(); // Executa ao carregar a página
    });
    
