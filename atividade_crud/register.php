<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';
if(is_logged_in()) header('Location: tarefas/listar.php');
$msg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if(!$nome || !$email || !$senha){
        $msg = 'Preencha todos os campos.';
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg = 'Email inválido.';
    }else{
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        if($stmt->fetch()){
            $msg = 'Email já cadastrado.';
        }else{
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
            $stmt->execute([$nome, $email, $hash]);
            $msg = 'Cadastro realizado! Faça login.';
        }
    }
}
include 'includes/header.php';
?>
<h2>Cadastro de Usuário</h2>
<form method="post">
  <div class="form-group">
    <label>Nome</label>
    <input type="text" name="nome" required>
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" required>
  </div>
  <div class="form-group">
    <label>Senha</label>
    <input type="password" name="senha" required>
  </div>
  <button class="button" type="submit">Cadastrar</button>
</form>
<?php if($msg): ?><div class="msg"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
<p><a href="login.php">Já tem conta? Login</a></p>
<?php include 'includes/footer.php'; ?>
