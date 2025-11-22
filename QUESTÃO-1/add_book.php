require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor  = trim($_POST['autor'] ?? '');
    $ano    = trim($_POST['ano'] ?? '');

    $errors = [];

    if ($titulo === '') $errors[] = 'O título é obrigatório.';
    if ($autor === '') $errors[] = 'O autor é obrigatório.';
    if ($ano === '' || !filter_var($ano, FILTER_VALIDATE_INT)) $errors[] = 'Ano inválido.';
    else $ano = (int) $ano;

    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>";
        echo "</ul><a href='index.php'>Voltar</a>";
        exit;
    }

    try {
        $stmt = $db->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:titulo, :autor, :ano)");
        $stmt->execute([':titulo' => $titulo, ':autor' => $autor, ':ano' => $ano]);
    } catch (PDOException $e) {
        die("Erro ao inserir livro: " . htmlspecialchars($e->getMessage()));
    }
}

header('Location: index.php');
exit;
