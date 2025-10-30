# Gerenciador de Tarefas Kanban

Sistema web para gerenciamento de tarefas em formato Kanban, com controle de usuários, prioridades e status.

## Instalação
1. Importe o banco de dados usando os scripts em `sql/create_tables.sql` e `sql/seed_data.sql`.
2. Configure o acesso ao MySQL em `db.php` se necessário.
3. Coloque a pasta no seu servidor local (ex: XAMPP).
4. Acesse as telas pelo navegador:
   - `/public/usuarios.html` — Cadastro de usuário
   - `/public/tarefas.html` — Cadastro de tarefa
   - `/public/index.html` — Quadro Kanban

## Funcionalidades
- Cadastro de usuários
- Cadastro de tarefas vinculadas a usuários
- Visualização e movimentação de tarefas no Kanban (A Fazer, Fazendo, Pronto)
- Edição, exclusão e alteração de status das tarefas
- Prioridades coloridas (baixa, média, alta)

## Estrutura
- `db.php` — conexão MySQL
- `api/` — endpoints PHP para CRUD
- `public/` — interface HTML/CSS/JS
- `sql/` — scripts SQL

## Observações
- O sistema utiliza AJAX para comunicação entre frontend e backend.
- O layout é responsivo e colorido conforme prioridade.

## Exemplo de uso
1. Cadastre um usuário.
2. Cadastre uma tarefa vinculando ao usuário.
3. Gerencie as tarefas no quadro Kanban.

---
Desenvolvido para indústria alimentícia, modelo Kanban simples.
