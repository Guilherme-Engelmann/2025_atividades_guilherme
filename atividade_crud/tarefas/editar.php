<?php
require_once '../includes/auth.php';
require_login();
require_once '../includes/db.php';
$id = intval($_GET['id'] ?? 0);
$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare('SELECT * FROM tarefas WHERE id = ? AND usuario_id = ?');
$stmt->execute([$id, $usuario_id]);
$tarefa = $stmt->fetch();
if(!$tarefa){
    header('Location: listar.php');
    exit;
}
$msg = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $titulo = trim($_POST['titulo']??'');
    $descricao = trim($_POST['descricao']??'');
    $prioridade = $_POST['prioridade']??'Baixa';
    $status = $_POST['status']??'A Fazer';
    if(!$titulo || !$descricao){
        $msg = 'Preencha todos os campos obrigatórios.';
    }else{
        $stmt = $pdo->prepare('UPDATE tarefas SET titulo=?, descricao=?, prioridade=?, status=? WHERE id=? AND usuario_id=?');
        $stmt->execute([$titulo, $descricao, $prioridade, $status, $id, $usuario_id]);
        header('Location: listar.php');
        exit;
    }
}
include '../includes/header.php';
?>
<h2>Editar Tarefa</h2>
<form method="post">
  <div class="form-group">
    <label>Título</label>
    <input type="text" name="titulo" value="<?=htmlspecialchars($tarefa['titulo'])?>" required>
  </div>
  <div class="form-group">
    <label>Descrição</label>
    <textarea name="descricao" required><?=htmlspecialchars($tarefa['descricao'])?></textarea>
    <button type="button" id="sugestao" class="button secondary">Sugerir tarefa</button>
  </div>
  <div class="form-group">
    <label>Prioridade</label>
    <select name="prioridade">
      <option <?=$tarefa['prioridade']=='Baixa'?'selected':''?>>Baixa</option>
      <option <?=$tarefa['prioridade']=='Média'?'selected':''?>>Média</option>
      <option <?=$tarefa['prioridade']=='Alta'?'selected':''?>>Alta</option>
    </select>
  </div>
  <div class="form-group">
    <label>Status</label>
    <select name="status">
      <option <?=$tarefa['status']=='A Fazer'?'selected':''?>>A Fazer</option>
      <option <?=$tarefa['status']=='Fazendo'?'selected':''?>>Fazendo</option>
      <option <?=$tarefa['status']=='Pronto'?'selected':''?>>Pronto</option>
    </select>
  </div>
  <button class="button" type="submit">Salvar</button>
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
