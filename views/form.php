<?php

// Verifica se há erros ou dados na sessão
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']); // Limpa os erros depois de exibi-los
} else {
    $errors = [];
}

// Verifica se há dados de formulário armazenados na sessão, persiste os dados mesmo se os campos forem invalidos, ou seja, mantem o campo preenchido.
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['form_data']); // Limpa os dados do formulário após usá-los
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Preencha o formulário para realizar o quiz</h2>
    <!-- Action: Envia os dados do formulario para o index.php onde no case é igual a 'form'. -->
    <form action="index.php?page=form" method="post">
        
        <!-- Nome -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input class="form-control" type="text" maxlength="80" id="nome" name="nome" placeholder="Seu nome completo" 
                value="<?php echo isset($formData['nome']) ? $formData['nome'] : ''; ?>">
            <?php if (isset($errors['nome'])): ?>
                <!-- Verifica se existe em 'erros' uma chave 'nome'.
                    Se existir exibe uma mensagem de erro, a mensagem é o valor da chave. 
                -->
                <div class="text"><span class="msg-error-form"><?php echo $errors['nome']; ?></span></div>
            <?php endif; ?>
        </div>

        <!-- Idade -->
        <div class="mb-3">
            <label for="idade" class="form-label">Idade:</label>
            <input class="form-control" type="text" maxlength="2" id="idade" name="idade" placeholder="Sua Idade" 
                value="<?php echo isset($formData['idade']) ? $formData['idade'] : ''; ?>">
            <?php if (isset($errors['idade'])): ?>
                <div class="text"><span class="msg-error-form"><?php echo $errors['idade']; ?></span></div>
            <?php endif; ?>
        </div>

        <!-- CPF -->
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input class="form-control" maxlength="14" type="text" id="cpf" name="cpf" placeholder="111.222.333-44" 
                value="<?php echo isset($formData['cpf']) ? $formData['cpf'] : ''; ?>">
            <?php if (isset($errors['cpf'])): ?>
                <div class="text"><span class="msg-error-form"><?php echo $errors['cpf']; ?></span></div>
            <?php endif; ?>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input class="form-control" type="email" id="email" name="email" placeholder="nomeUsuario@dominio.com" value="<?php echo isset($formData['email']) ? $formData['email'] : ''; ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="text"><span class="msg-error-form"><?php echo $errors['email']; ?></span></div>
            <?php endif; ?>
        </div>

        <!-- Botão de Enviar -->
        <div class="text-center">
            <button type="submit" class="btn btn-formulario">Enviar</button>
        </div>
    </form>
</div>
