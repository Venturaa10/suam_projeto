<?php

// Verifica se a pontuação está disponível na sessão
$pontos = $_SESSION['pontuacao'] ?? 0;
$nomeEstudante = $_SESSION['nomeEstudante'];

// Definir a mensagem com base na pontuação
if ($pontos == 100) {
    $mensagem = "Incrível! Você acertou todas as questões! 🎉";
} elseif ($pontos >= 80) {
    $mensagem = "Excelente desempenho! Você acertou a maioria das questões! 🚀";
} elseif ($pontos >= 60) {
    $mensagem = "Muito bem! Você tem um bom conhecimento, continue assim! 👍";
} elseif ($pontos >= 40) {
    $mensagem = "Bom esforço! Com um pouco mais de prática, você pode melhorar! 💪";
} else {
    $mensagem = "Não desanime! Revise os conteúdos e tente novamente! 📚";
}

// Limpar a pontuação da sessão para não ficar armazenada em outros lugares
// unset($_SESSION['pontuacao']);
// unset($_SESSION['nomeEstudante']);
?>


<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body text-center">
                        <h1 class="text-primary fw-bold">Resultado do Quiz</h1>
                        <h5 class="text-muted"><?= $nomeEstudante ?></h5>
                        <p class="fs-4">Sua pontuação: <span class="fw-bold"><?= $pontos ?> pontos</span></p>
                        <p class="lead"><?= $mensagem ?></p>
                        <a href="index.php" class="btn btn-primary mt-3">Voltar ao início</a>
                    </div>
                </div>
            </div>
        </div>
    </div>