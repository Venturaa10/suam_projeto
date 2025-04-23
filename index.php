<?php
session_start();

// Define qual página carregar, por padrão será a home
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Define o conteúdo que será passado para o layout
switch ($page) {
    case 'form':
        unset($_SESSION['estudante_id']); // Limpa id antigo (evita acesso não intencional)

        require_once __DIR__ . '/controllers/FormController.php';
        $controller = new FormController();
        $controller->processForm(); // Chama o método para processar o formulário       
        $pageContent = 'views/form.php'; // Define o conteúdo da página

        break;

    case 'quiz':

        // ✅ Verifica se o estudante já preencheu o formulário
        if (!isset($_SESSION['estudante_id'])) {
            // Redireciona de volta ao formulário, evitando o acesso ao quiz via url no navegador.
            header("Location: index.php?page=form");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/controllers/QuizController.php';
            $controller = new QuizController();
            $controller->processarQuiz($_POST);
        } else {
            $pageContent = 'views/quiz.php'; // Página do quiz
        }
        break;

    case 'estatisticas':
        require_once __DIR__ . '/controllers/EstatisticaController.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // EstatisticaController::processarConsultaPorCPF($_POST);
            header('Location: index.php?page=estatisticas');
            exit;
        } else {
            $pageContent = 'views/estatisticas.php';
        }
        break;
        
    case 'feedback':
        // ✅ Verifica se o estudante já preencheu o formulário
        if (!isset($_SESSION['estudante_id'])) {
            // Redireciona de volta ao formulário, evitando o acesso ao quiz via url no navegador.
            header("Location: index.php?page=form");
            exit();
        }
        unset($_SESSION['estudante_id']); // Limpa id antigo (evita acesso não intencional)

        $pageContent = 'views/feedback.php'; // Página de quiz
        break;

    case 'home': 
    default:
        $pageContent = 'views/home.php'; // Página inicial
        break;
}

include __DIR__ . '/views/layout.php'; // Garante o caminho correto
?>

