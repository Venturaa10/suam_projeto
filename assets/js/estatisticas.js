fetch('api/estatisticas.php')
  .then(res => res.json())
  .then(data => {
    console.log(`Dados carregados com sucesso.`);
    const totalParticipantes = document.querySelector('#total-participantes');
    const mediaPontos = document.querySelector('#media-pontos');

    // Removendo o spinner antes de atualizar o conteúdo
    const spinnerTotal = totalParticipantes.querySelector('.spinner');
    const spinnerMedia = mediaPontos.querySelector('.spinner');

    if (spinnerTotal) spinnerTotal.remove();
    if (spinnerMedia) spinnerMedia.remove();

    // Protege contra NaN
    const media = parseFloat(data.media_pontos);
    const mediaFormatada = isNaN(media) ? '0.00' : media.toFixed(2);

    totalParticipantes.innerHTML = `${data.total_resultados}`;
    mediaPontos.innerHTML = `${mediaFormatada}`;

    totalParticipantes.classList.add('loaded');
    mediaPontos.classList.add('loaded');
  })
  .catch(() => {
    console.log('Erro ao carregar os dados.');
    document.querySelector('#total-participantes').textContent = 'Erro ao carregar dados';
    document.querySelector('#media-pontos').textContent = 'Erro ao carregar dados';
  });

function mostrarFormulario() {
  const form = document.getElementById('form-cpf');
  const cpfInput = document.getElementById('cpf');
  const erro = document.getElementById('mensagem-erro');
  const resultado = document.getElementById('resultado-individual');

  if (form.style.display === 'none' || !form.style.display) {
    console.log('Exibindo o formulário do CPF, o usuario clicou no Mostar Méida.');
    form.style.display = 'block';
    cpfInput.value = '';
    cpfInput.focus();
    resultado.style.display = 'none';
    resultado.innerHTML = '';
  } else {
    form.style.display = 'none';
  }
}

document.getElementById('form-cpf').addEventListener('submit', async function (e) {
  e.preventDefault();

  const cpf = document.getElementById('cpf').value;
  const erro = document.getElementById('mensagem-erro');
  const resultado = document.getElementById('resultado-individual');
  const form = document.getElementById('form-cpf');

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
      console.log('CPF encontrado no banco de dados.');
      
      const media = parseFloat(json.dados.media);
      const mediaFormatada = isNaN(media) ? '0.00' : media.toFixed(2);

      resultado.innerHTML = `
        <p><strong>CPF:</strong> ${cpf}</p>
        <p><strong>Quantidade de vezes que fez o quiz:</strong> ${json.dados.quantidade}</p>
        <p><strong>Média de pontuação:</strong> ${mediaFormatada}</p>
      `;
      resultado.style.display = 'block';
      form.style.display = 'none';
      document.getElementById('cpf').value = '';
    } else {
      console.log('Caiu no erro');
      erro.innerHTML = `${json.mensagem}`;
      erro.style.display = 'block';

      setTimeout(() => {
        erro.style.display = 'none';
      }, 5000);
    }
  } catch (err) {
    console.log(`Ocorreu um erro no envio para a API. ${err}`);
    erro.textContent = "Erro ao buscar dados. Tente novamente.";
    erro.style.display = 'block';
  }
});
