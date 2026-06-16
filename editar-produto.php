<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';

// Se for POST, atualiza; se for GET, carrega para exibir o formulário.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);

    $nome = $_POST['nome'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $quantidade = (int)($_POST['quantidade'] ?? 0);
    $preco = (float)($_POST['preco'] ?? 0);

    if ($id <= 0) {
        header('Location: produtos.php?erro=1');
        exit();
    }

    // UPDATE com prepared statement
    $stmt = $cone->prepare('UPDATE produtos SET nome = ?, categoria = ?, quantidade = ?, preco = ? WHERE id = ?');
    $stmt->bind_param('ssdid', $nome, $categoria, $quantidade, $preco, $id);

    if ($stmt->execute()) {
        header('Location: produtos.php?sucesso=2');
        exit();
    }

    header('Location: editar-produto.php?id=' . $id . '&erro=1');
    exit();
}

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: produtos.php?erro=1');
    exit();
}

$stmt = $cone->prepare('SELECT id, nome, categoria, quantidade, preco FROM produtos WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$produto = $result->fetch_assoc();

if (!$produto) {
    header('Location: produtos.php?erro=1');
    exit();
}

$nome = $produto['nome'];
$categoria = $produto['categoria'];
$quantidade = $produto['quantidade'];
$preco = $produto['preco'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Produto</title>
    <link rel="stylesheet" href="index.css" />
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <div class="branding">
                <p class="eyebrow">Painel de Cadastro</p>
                <h1>Editar produto</h1>
                <p class="subtitle">Atualize os dados do item e mantenha o estoque em dia.</p>
            </div>
        </header>

        <main class="page-content">
            <section class="card form-card">
                <div class="card-header">
                    <h2>Formulário de edição</h2>
                    <p>Faça as alterações e clique em “Salvar alterações”.</p>
                </div>

                <form action="editar-produto.php" method="POST" class="product-form">
                    <input type="hidden" name="id" value="<?php echo (int)$produto['id']; ?>" />

                    <div class="field">
                        <label for="nome">Nome do produto</label>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            value="<?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>"
                            placeholder="Ex: Arroz integral"
                            required
                        />
                    </div>

                    <div class="field">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" name="categoria" required>
                            <?php
                            $categorias = ['Alimentos','Bebidas','Higiene','Limpeza'];
                            foreach ($categorias as $cat) {
                                $selected = ($cat === $categoria) ? 'selected' : '';
                                echo "<option value=\"" . htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') . "\" $selected>" . htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="field-group">
                        <div class="field">
                            <label for="quantidade">Quantidade</label>
                            <input
                                type="number"
                                id="quantidade"
                                name="quantidade"
                                value="<?php echo (int)$quantidade; ?>"
                                placeholder="0"
                                min="0"
                            />
                        </div>

                        <div class="field">
                            <label for="preco">Preço (R$)</label>
                            <input
                                type="number"
                                id="preco"
                                name="preco"
                                value="<?php echo htmlspecialchars((string)$preco, ENT_QUOTES, 'UTF-8'); ?>"
                                placeholder="0.00"
                                min="0"
                                step="0.01"
                            />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar alterações</button>

                    <a href="produtos.php" class="small-note" style="display:inline-block;text-decoration:none;">
                        Voltar para a lista
                    </a>
                </form>
            </section>

            <section class="card info-card">
                <h3>Dicas rápidas</h3>
                <p>Para manter os dados corretos:</p>
                <ul class="tips">
                    <li>Confira nome e categoria antes de salvar</li>
                    <li>Use preço com duas casas decimais</li>
                    <li>Mantenha quantidade sempre atualizada</li>
                </ul>
                <p class="small-note">Você pode voltar para <strong>produtos.php</strong> a qualquer momento.</p>
            </section>
        </main>

        <footer class="footer">Sistema de supermercado • Layout limpo e responsivo</footer>
    </div>

    <script src="index.js"></script>
</body>
</html>

