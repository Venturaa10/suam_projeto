function mostrarFormulario() {
    const form = document.getElementById('form-cpf');
    const erro = document.getElementById('mensagem-erro');
    const resultado = document.getElementById('resultado-individual');
    const cpfInput = document.getElementById('cpf'); // Obtém o campo de CPF

    // Alterna visibilidade do formulário
    if (form.style.display === 'none' || !form.style.display) {
        form.style.display = 'block';
        cpfInput.value = ''; // Limpa o campo de CPF ao exibir o formulário
    } else {
        form.style.display = 'none';
    }

    // Oculta os resultados anteriores
    if (erro) erro.style.display = 'none';
    if (resultado) resultado.style.display = 'none';
}
