<?php
try {
    $db = new PDO('sqlite:' . __DIR__ . '/livros.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec('PRAGMA busy_timeout = 5000');

    $db->exec("
        CREATE TABLE IF NOT EXISTS livros (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            autor TEXT NOT NULL,
            ano INTEGER NOT NULL
        )
    ");
} catch (PDOException $e) {
    die("Erro ao conectar ao banco: " . htmlspecialchars($e->getMessage()));
}
