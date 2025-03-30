<?php
// Carregar as perguntas do arquivo de configuração
$perguntas = include __DIR__ . '/../config/perguntas.php'; // Subindo um nível e acessando a pasta 'config'
?>
<form action="index.php?page=quiz" method="POST">
    <?php foreach ($perguntas as $pergunta): ?>
        <div>
            <label><?php echo $pergunta['texto']; ?></label><br>
            <?php foreach ($pergunta['opcoes'] as $letra => $opcao): ?>
                <input type="radio" name="<?php echo $pergunta['id']; ?>" value="<?php echo $letra; ?>" required> <?php echo $opcao; ?><br>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <button type="submit">Enviar</button>
</form>