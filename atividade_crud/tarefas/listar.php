<?php
require_once '../includes/auth.php';
require_login();
require_once '../includes/db.php';
include '../includes/header.php';
$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare('SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC');
$stmt->execute([$usuario_id]);
$tarefas = $stmt->fetchAll();
function prioridade_class($p){
    return $p=='Alta'?'priority-alta':($p=='Média'?'priority-media':'priority-baixa');
}
function status_col($s){
    return strtolower(str_replace(' ', '-', $s));
}
?>
<h2>Meu Kanban</h2>
<div class="kanban">
  <?php foreach(['A Fazer','Fazendo','Pronto'] as $status): ?>
  <div class="column" id="col-<?=status_col($status)?>">
    <h2><?= $status ?></h2>
    <?php foreach($tarefas as $t): if($t['status']==$status): ?>
      <div class="card <?= prioridade_class($t['prioridade']) ?>">
        <strong><?= htmlspecialchars($t['titulo']) ?></strong>
        <div class="meta">Prioridade: <?= $t['prioridade'] ?> | Criada em: <?= date('d/m/Y H:i',strtotime($t['data_criacao'])) ?></div>
        <div><?= nl2br(htmlspecialchars($t['descricao'])) ?></div>
        <div class="actions">
          <a class="button" href="editar.php?id=<?=$t['id']?>">Editar</a>
          <a class="button secondary" href="excluir.php?id=<?=$t['id']?>" onclick="return confirm('Excluir tarefa?')">Excluir</a>
          <form method="post" action="mover.php" style="display:inline">
            <select name="status" onchange="this.form.submit()">
              <?php foreach(['A Fazer','Fazendo','Pronto'] as $opt): ?>
                <option value="<?=$opt?>" <?=$opt==$status?'selected':''?>><?=$opt?></option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" name="id" value="<?=$t['id']?>">
          </form>
        </div>
      </div>
    <?php endif; endforeach; ?>
  </div>
  <?php endforeach; ?>
</div>
<p><a href="criar.php" class="button">Nova Tarefa</a></p>
<?php include '../includes/footer.php'; ?>
