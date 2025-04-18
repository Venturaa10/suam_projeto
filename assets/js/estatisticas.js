function mostrarFormulario() {
    const form = document.getElementById('form-cpf');
    const erro = document.getElementById('mensagem-erro');
    const resultado = document.getElementById('resultado-individual');

    // Alterna visibilidade do formulário
    if (form.style.display === 'none' || !form.style.display) {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }

    // Oculta os resultados anteriores
    if (erro) erro.style.display = 'none';
    if (resultado) resultado.style.display = 'none';
}