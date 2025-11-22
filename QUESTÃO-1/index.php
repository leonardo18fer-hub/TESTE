<?php
require_once 'database.php';

try {
    $stmt = $db->query("SELECT * FROM livros ORDER BY id DESC");
    $livros = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erro ao buscar livros: " . htmlspecialchars($e->getMessage()));
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Livraria</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 20px auto;
            padding: 0 10px;
            background: #f0f2f5;
        }
        h1 {
            color: #1e3799;
            text-align: center;
        }
        form {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        label { font-weight: bold; }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            padding: 10px 18px;
            background: #1e3799;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0c2461;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        th {
            background: #1e3799;
            color: white;
            padding: 10px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        tr:hover {
            background: #f1f1f1;
        }
        a {
            color: #d63031;
            text-decoration: none;
            font-weight: bold;
        }
    </style>

    <script>
        function confirmDelete(id, title) {
            if (confirm('Excluir o livro "' + title + '"?')) {
                window.location.href = 'delete_book.php?id=' + id;
            }
            return false;
        }
    </script>
</head>
<body>

<h1>📚 Livraria</h1>

<h2>Adicionar Livro</h2>

<form action="add_book.php" method="post">
    <label>Título</label>
    <input type="text" name="titulo" required>

    <label>Autor</label>
    <input type="text" name="autor" required>

    <label>Ano</label>
    <input type="number" name="ano" required>

    <button type="submit">Adicionar</button>
</form>

<h2>Livros Cadastrados</h2>

<?php if (empty($livros)): ?>
    <p>Nenhum livro cadastrado.</p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ano</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($livros as $livro): ?>
        <tr>
            <td><?= htmlspecialchars($livro['id']) ?></td>
            <td><?= htmlspecialchars($livro['titulo']) ?></td>
            <td><?= htmlspecialchars($livro['autor']) ?></td>
            <td><?= htmlspecialchars($livro['ano']) ?></td>
            <td><a href="#" onclick="return confirmDelete(<?= $livro['id'] ?>, '<?= htmlspecialchars(addslashes($livro['titulo'])) ?>')">Excluir</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

</body>
</html>
