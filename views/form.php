<?php
$title = "Formulario";


?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Preencha o formulário para realizar o quiz</h2>
    <form action="index.php?page=form" method="post">
        
        <!-- Nome -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input class="form-control" type="text" maxlength="80" id="nome" name="nome" placeholder="Seu nome completo" 
                value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : ''; ?>">
            <?php if (isset($errors['nome'])): ?>
                <div class="text-danger"><?php echo $errors['nome']; ?></div>
            <?php endif; ?>
        </div>

        <!-- Idade -->
        <div class="mb-3">
            <label for="idade" class="form-label">Idade:</label>
            <input class="form-control" type="text" maxlength="2" id="idade" name="idade" placeholder="Sua Idade" 
                value="<?php echo isset($_POST['idade']) ? $_POST['idade'] : ''; ?>">
            <?php if (isset($errors['idade'])): ?>
                <div class="text-danger"><?php echo $errors['idade']; ?></div>
            <?php endif; ?>
        </div>

        <!-- CPF -->
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input class="form-control" maxlength="14" type="text" id="cpf" name="cpf" placeholder="111.222.333-44" 
                value="<?php echo isset($_POST['cpf']) ? $_POST['cpf'] : ''; ?>">
            <?php if (isset($errors['cpf'])): ?>
                <div class="text-danger"><?php echo $errors['cpf']; ?></div>
            <?php endif; ?>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input class="form-control" type="email" id="email" name="email" placeholder="nomeUsuario@dominio.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="text-danger"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </div>

        <!-- Botão de Enviar -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>

