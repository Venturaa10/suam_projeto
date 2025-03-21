<?php
// Define qual página carregar, por padrão será a home
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Define o conteúdo que será passado para o layout
switch ($page) {
    case 'form':
        $pageContent = 'views/form.php'; // Página do formulário
        break;
    case 'home':
    default:
        $pageContent = 'views/home.php'; // Página inicial
        break;
}

// Inclui o layout, passando a página de conteúdo
include __DIR__ . '/views/layout.php'; // Garante o caminho correto
?>

