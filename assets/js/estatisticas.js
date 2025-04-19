fetch('api/estatisticas.php')
  .then(res => res.json())
  .then(data => {
    console.log(`Dados carregados com sucesso.`)
    const totalParticipantes = document.querySelector('#total-participantes');
    const mediaPontos = document.querySelector('#media-pontos');

    // Removendo o spinner antes de atualizar o conteúdo
    const spinnerTotal = totalParticipantes.querySelector('.spinner');
    const spinnerMedia = mediaPontos.querySelector('.spinner');

    if (spinnerTotal) spinnerTotal.remove();  // Remove o spinner do total de participantes
    if (spinnerMedia) spinnerMedia.remove();  // Remove o spinner da média de pontos

    // Atualizando os valores, adicionando texto diretamente no conteúdo do elemento
    totalParticipantes.innerHTML = `${data.total_resultados}`;
    mediaPontos.innerHTML = `${parseFloat(data.media_pontos).toFixed(2)}`;

    // Caso queira adicionar uma animação ou transição para os valores
    totalParticipantes.classList.add('loaded');
    mediaPontos.classList.add('loaded');
  })
  .catch(() => {
    // Caso haja erro, mostrar uma mensagem informando
    console.log('Erro ao carregar os dados.')
    document.querySelector('#total-participantes').textContent = 'Erro ao carregar dados';
    document.querySelector('#media-pontos').textContent = 'Erro ao carregar dados';
  });


function mostrarFormulario() {
    const form = document.getElementById('form-cpf');
    const cpfInput = document.getElementById('cpf');
    const erro = document.getElementById('mensagem-erro');
    const resultado = document.getElementById('resultado-individual');

    if (form.style.display === 'none' || !form.style.display) {
        console.log('Exibindo o formulário do CPF, o usuario clicou no Mostar Méida.')
        // Mostrar o formulário
        form.style.display = 'block';
        cpfInput.value = '';
        cpfInput.focus();

        // Só limpa e esconde o erro se o form estiver sendo aberto
        resultado.style.display = 'none';
        resultado.innerHTML = '';
    } else {
        // Oculta o formulário
        form.style.display = 'none';
    }
}


document.getElementById('form-cpf').addEventListener('submit', async function (e) {
    e.preventDefault();

    const cpf = document.getElementById('cpf').value;
    const erro = document.getElementById('mensagem-erro');
    const resultado = document.getElementById('resultado-individual');
    const form = document.getElementById('form-cpf');

    // Limpa mensagens anteriores
    erro.style.display = 'none';
    resultado.style.display = 'none';
    resultado.innerHTML = '';

    try {
        const response = await fetch('api/buscar_por_cpf.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `cpf=${encodeURIComponent(cpf)}`
        });

        const json = await response.json();

        if (json.status === 'ok') {
            console.log('CPF encontrado no banco de dados.')
            resultado.innerHTML = `
                <p><strong>Nome:</strong> ${json.dados.nome}</p>
                <p><strong>CPF:</strong> ${cpf}</p>
                <p><strong>Quantidade de vezes que fez o quiz:</strong> ${json.dados.quantidade}</p>
                <p><strong>Média de pontuação:</strong> ${parseFloat(json.dados.media).toFixed(2)}</p>
            `;
            resultado.style.display = 'block';
            form.style.display = 'none';
            document.getElementById('cpf').value = ''; // limpa o campo
        } else {
            console.log('Caiu no erro')
            erro.innerHTML = `${json.mensagem}`
            erro.style.display = 'block';
            // document.getElementById('cpf').value = ''; // limpa o campo
            setTimeout(() => {
                erro.style.display = 'none'; // Esconde a mensagem dps dois segundos.
            }, 5000); // 6 segundos
        }
    } catch (err) {
        console.log(`Ocorreu um erro no envio para a API. ${err}`)
        erro.textContent = "Erro ao buscar dados. Tente novamente.";
        erro.style.display = 'block';
    }
});
