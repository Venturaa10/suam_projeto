<?php
require_once 'controllers/EstatisticaController.php';
$estatisticas = EstatisticaController::obterEstatisticas();

// $resultado_individual = $_SESSION['resultado_individual'] ?? null;
// $mensagem = $_SESSION['mensagem'] ?? null;
// $cpf_digitado = $_SESSION['cpf_digitado'] ?? '';

// unset($_SESSION['resultado_individual'], $_SESSION['mensagem'], $_SESSION['cpf_digitado']);
?>


<div class="stats-container">
<h2 class="stats-title">📊 Estatísticas do Quiz</h2>
<div id="estatisticas">
<p class="stat-item">Total de participantes:
  <span class="stat-value" id="total-participantes">
    <span class="spinner"></span> Carregando...
  </span>
</p>

<p class="stat-item">Média de pontos:
  <span class="stat-value" id="media-pontos">
    <span class="spinner"></span> Carregando...
  </span>
</p>

</div>  


    <div class="cpf-section">
        <button class="mostrar-form-btn" onclick="mostrarFormulario()">Consultar Minha Média</button>

        <form method="POST" class="cpf-form" id="form-cpf" style="display:none;">
            <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF cadastrado" maxlength="14">
            <div class="div-error-estatisticas"><span class="msg-error-form-estatisticas" id="mensagem-erro" style="display: none;"></span></div>
            <button type="submit">Buscar</button>
        </form>

        <div class="resultado-individual" id="resultado-individual" style="display:none;"></div>

    </div>
</div>
