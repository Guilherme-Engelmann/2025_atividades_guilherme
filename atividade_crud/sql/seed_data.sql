USE gerenciador_kanban;

INSERT INTO usuarios (nome, email) VALUES
('Ana Silva', 'ana.silva@empresa.com'),
('Bruno Costa', 'bruno.costa@empresa.com'),
('Carla Pereira', 'carla.pereira@empresa.com');

INSERT INTO tarefas (id_usuario, descricao, setor, prioridade, status) VALUES
(1, 'Verificar estoque de embalagens', 'Logística', 'alta', 'a fazer'),
(1, 'Revisar lote B12', 'Qualidade', 'media', 'fazendo'),
(2, 'Aprovar nota fiscal', 'Financeiro', 'baixa', 'pronto'),
(3, 'Testar nova receita', 'Produção', 'alta', 'a fazer');
