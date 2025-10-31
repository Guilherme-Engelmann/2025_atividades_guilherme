<?php
require_once '../includes/auth.php';
require_login();
require_once '../includes/db.php';
$msg = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $titulo = trim($_POST['titulo']??'');
    $descricao = trim($_POST['descricao']??'');
    $prioridade = $_POST['prioridade']??'Baixa';
    $status = $_POST['status']??'A Fazer';
    $usuario_id = $_SESSION['usuario_id'];
    if(!$titulo || !$descricao){
        $msg = 'Preencha todos os campos obrigatórios.';
    }else{
        $stmt = $pdo->prepare('INSERT INTO tarefas (titulo, descricao, prioridade, status, usuario_id) VALUES (?,?,?,?,?)');
        $stmt->execute([$titulo, $descricao, $prioridade, $status, $usuario_id]);
        header('Location: listar.php');
        exit;
    }
}
include '../includes/header.php';
?>
<h2>Criar Tarefa</h2>
<form method="post">
  <div class="form-group">
    <label>Título</label>
    <input type="text" name="titulo" required>
  </div>
  <div class="form-group">
    <label>Descrição</label>
    <textarea name="descricao" required></textarea>
    <button type="button" id="sugestao" class="button secondary">Sugerir tarefa</button>
  </div>
  <div class="form-group">
    <label>Prioridade</label>
    <select name="prioridade">
      <option>Baixa</option>
      <option>Média</option>
      <option>Alta</option>
    </select>
  </div>
  <div class="form-group">
    <label>Status</label>
    <select name="status">
      <option>A Fazer</option>
      <option>Fazendo</option>
      <option>Pronto</option>
    </select>
  </div>
  <button class="button" type="submit">Criar</button>
</form>
<?php if($msg): ?><div class="msg"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
<p><a href="listar.php">Voltar ao Kanban</a></p>
<script>
document.getElementById('sugestao').onclick = async function(){
  const res = await fetch('../api/sugestao.php');
  const data = await res.json();
  if(data.activity){
    document.querySelector('textarea[name=descricao]').value = data.activity;
  }
};
</script>
<?php include '../includes/footer.php'; ?>
