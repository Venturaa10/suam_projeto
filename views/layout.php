<?php include __DIR__ . '/partials/header.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<div class="content">
    <?php 
    // Verifique se $pageContent foi definido corretamente antes de incluir
    if (isset($pageContent)) {
        include __DIR__ . '/../' . $pageContent; 
    } else {
        echo "Conteúdo não definido!";
    }
    ?>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
