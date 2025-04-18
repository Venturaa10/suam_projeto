<?php
session_start();

// Define qual página carregar, por padrão será a home
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Define o conteúdo que será passado para o layout
switch ($page) {
    case 'form':
        require_once __DIR__ . '/controllers/FormController.php';
        $controller = new FormController();
        $controller->processForm(); // Chama o método para processar o formulário       
        $pageContent = 'views/form.php'; // Define o conteúdo da página

        break;

    case 'quiz':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica se o formulário foi enviado
            require_once __DIR__ . '/controllers/QuizController.php'; // Importa o controlador do quiz.
            $controller = new QuizController(); // Instancia o controlador do quiz.
            $controller->processarQuiz($_POST); // Chama o método para processar o quiz.
        } else {
            $pageContent = 'views/quiz.php'; // Página de quiz
        }
        break;

    case 'estatisticas':
        require_once __DIR__ . '/controllers/EstatisticaController.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            EstatisticaController::processarConsultaPorCPF($_POST);
            header('Location: index.php?page=estatisticas');
            exit;
        } else {
            $pageContent = 'views/estatisticas.php';
        }
        break;
        
    case 'feedback':
        $pageContent = 'views/feedback.php'; // Página de quiz
        break;

    case 'home': 
    default:
        $pageContent = 'views/home.php'; // Página inicial
        break;
}

include __DIR__ . '/views/layout.php'; // Garante o caminho correto
?>

