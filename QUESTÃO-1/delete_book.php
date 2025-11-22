<?php
require_once 'database.php';

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $stmt = $db->prepare("DELETE FROM livros WHERE id = :id");
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        die("Erro ao excluir livro: " . htmlspecialchars($e->getMessage()));
    }
}

header('Location: index.php');
exit;
