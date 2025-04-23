<?php
require_once __DIR__ . '/../models/PontuacaoQuiz.php';
require_once __DIR__ . '/../models/EstudanteModel.php'; // Importar classe Estudante

class QuizController {
    public static function processarQuiz() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php");
            exit(); // Garante que o código não continue
        }
    
        session_start(); // Inicia a sessão

        $pontos = 0;
    
        // Respostas corretas
        $respostasCorretas = [
            'pergunta1' => 'C',
            'pergunta2' => 'B',
            'pergunta3' => 'D',
            'pergunta4' => 'C',
            'pergunta5' => 'A',
            'pergunta6' => 'B',
            'pergunta7' => 'C',
            'pergunta8' => 'C',
            'pergunta9' => 'D',
            'pergunta10' => 'B'
        ];
    
        // Percorrer as respostas e calcular os pontos
        foreach ($respostasCorretas as $pergunta => $respostaCorreta) {
            if (isset($_POST[$pergunta]) && $_POST[$pergunta] === $respostaCorreta) {
                $pontos += 10; // 10 pontos por resposta correta
            }
        }
    
        // Coletar informações do estudante
        $estudante_id = $_SESSION['estudante_id'] ?? null; // Agora pega o ID diretamente da sessão
    
        // Verifica se o estudante_id foi encontrado
        if ($estudante_id === null) {
            die("Erro: Estudante não encontrado.");
        }
    
        // Recupera os dados do estudante a partir do ID armazenado na sessão
        // Isso é importante para garantir que o estudante correto seja referenciado no banco de dados e a sua pontuação no quiz.
        $estudante = Estudante::getEstudanteById($estudante_id);
        if ($estudante === null) {
            die("Erro: Estudante não encontrado no banco de dados.");
        }
    
        // Extrair os dados do estudante
        $nome = $estudante['nome'] ?? 'Desconhecido';
        $email = $estudante['email'] ?? 'sememail@example.com';
        $cpf = $estudante['cpf'] ?? '000.000.000-00';
    
        // Salvar pontuação no banco
        PontuacaoQuiz::save($estudante_id, $nome, $email, $cpf, $pontos);
    
        // Armazena variaveis que serão utilizadas na página de feedback
        $_SESSION['pontuacao'] = $pontos;
        $_SESSION['nomeEstudante'] = $nome;

        // Redireciona para a página de feedback, após salvar a pontuação e as informações do estudante no banco de dados.
        header("Location: index.php?page=feedback");
        exit(); // Garante que o redirecionamento seja o último passo
    }
    
    
}
