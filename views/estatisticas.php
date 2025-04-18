<?php
require_once 'controllers/EstatisticaController.php';
$estatisticas = EstatisticaController::obterEstatisticas();

$resultado_individual = $_SESSION['resultado_individual'] ?? null;
$mensagem = $_SESSION['mensagem'] ?? null;
$cpf_digitado = $_SESSION['cpf_digitado'] ?? '';

unset($_SESSION['resultado_individual'], $_SESSION['mensagem'], $_SESSION['cpf_digitado']);
?>


<div class="stats-container">
    <h2 class="stats-title">📊 Estatísticas do Quiz</h2>
    <p class="stat-item">Total de participantes: <span class="stat-value"><?= $estatisticas['total_resultados'] ?></span></p>
    <p class="stat-item">Média de pontos: <span class="stat-value"><?= number_format($estatisticas['media_pontos'],2 ) ?></span></p>

    <div class="cpf-section">
        <button class="mostrar-form-btn" onclick="mostrarFormulario()">Consultar Minha Média</button>

        <form method="POST" class="cpf-form" id="form-cpf">
            <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF cadastrado" maxlength="14" value="<?= htmlspecialchars($cpf_digitado) ?>" required>
            <button type="submit">Buscar</button>
        </form>

        <?php if ($mensagem): ?>
            <span class="msg-error-form" id="mensagem-erro"><?= $mensagem ?></span>
        <?php elseif ($resultado_individual): ?>
            <div class="resultado-individual" id="resultado-individual">
                <p><strong>Nome:</strong> <?= htmlspecialchars($resultado_individual['nome']) ?></p>
                <p><strong>CPF:</strong> <?= htmlspecialchars($cpf_digitado) ?></p>
                <p><strong>Quantidade de vezes que fez o quiz:</strong> <?= $resultado_individual['quantidade'] ?></p>
                <p><strong>Média de pontuação:</strong> <?= number_format($resultado_individual['media'], 2) ?></p>
            </div>
        <?php endif; ?>

    </div>
</div>