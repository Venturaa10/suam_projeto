
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