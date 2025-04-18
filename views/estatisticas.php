<?php
require_once 'controllers/EstatisticaController.php';

$estatisticas = EstatisticaController::obterEstatisticas();
$resultado_individual = null;
$mensagem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cpf'])) {
    $cpf = preg_replace('/\D/', '', $_POST['cpf']); // Remove qualquer caractere não numérico
    $resultado_individual = EstatisticaController::obterEstatisticaPorCPF($cpf);

    if (!$resultado_individual) {
        $mensagem = "⚠️ Nenhum resultado encontrado para este CPF.";
    }
}
?>


<div class="stats-container">
        <h2 class="stats-title">📊 Estatísticas do Quiz</h2>
        <p class="stat-item">Total de participantes: <span class="stat-value"><?= $estatisticas['total_resultados'] ?></span></p>
        <p class="stat-item">Média de pontos: <span class="stat-value"><?= $estatisticas['media_pontos'] ?></span></p>

        <div class="cpf-section">
            <button class="mostrar-form-btn" onclick="mostrarFormulario()">Consultar Minha Média</button>

            <form method="POST" class="cpf-form" id="form-cpf">
                <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF cadastrado" maxlength="14" required>
                <button type="submit">Buscar</button>
            </form>

            <?php if ($mensagem): ?>
                <span class="msg-error-form" id="mensagem-erro"><?= $mensagem ?></span>
            <?php elseif ($resultado_individual): ?>
                <div class="resultado-individual" id="resultado-individual">
                    <p><strong>Nome:</strong> <?= htmlspecialchars($resultado_individual['nome']) ?></p>
                    <p><strong>CPF:</strong> <?= htmlspecialchars($_POST['cpf']) ?></p>
                    <p><strong>Quantidade de vezes que fez o quiz:</strong> <?= $resultado_individual['quantidade'] ?></p>
                    <p><strong>Média de pontuação:</strong> <?= $resultado_individual['media'] ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>
