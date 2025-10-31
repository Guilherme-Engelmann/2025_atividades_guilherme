<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';
if(is_logged_in()) header('Location: tarefas/listar.php');
$msg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if(!$email || !$senha){
        $msg = 'Preencha todos os campos.';
    }else{
        $stmt = $pdo->prepare('SELECT id, senha FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if($user && password_verify($senha, $user['senha'])){
            $_SESSION['usuario_id'] = $user['id'];
            header('Location: tarefas/listar.php');
            exit;
        }else{
            $msg = 'Email ou senha inválidos.';
        }
    }
}
include 'includes/header.php';
?>
<h2>Login</h2>
<form method="post">
  <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" required>
  </div>
  <div class="form-group">
    <label>Senha</label>
    <input type="password" name="senha" required>
  </div>
  <button class="button" type="submit">Entrar</button>
</form>
<?php if($msg): ?><div class="msg"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
<p><a href="register.php">Não tem conta? Cadastre-se</a></p>
<?php include 'includes/footer.php'; ?>
