<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';

$sql = "SELECT id, nome, categoria, quantidade, preco FROM produtos ORDER BY id DESC";
$resultado = $cone->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produtos</title>
    <link rel="stylesheet" href="index.css" />
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <div class="branding">
                <p class="eyebrow">Painel de Cadastro</p>
                <h1>Produtos cadastrados</h1>
                <p class="subtitle">Gerencie seu estoque: visualize e edite itens existentes.</p>
            </div>
        </header>

        <main class="page-content" style="grid-template-columns: 1fr;">
            <section class="card form-card">
                <div class="card-header">
                    <h2>Lista de produtos</h2>
                    <p>Use o botão “Editar” para atualizar os dados do produto.</p>
                </div>

                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:separate;border-spacing:0;">
                        <thead>
                            <tr>
                                <th style="text-align:left;padding:12px 10px;border-bottom:1px solid var(--border);color:#334155;">ID</th>
                                <th style="text-align:left;padding:12px 10px;border-bottom:1px solid var(--border);color:#334155;">Nome</th>
                                <th style="text-align:left;padding:12px 10px;border-bottom:1px solid var(--border);color:#334155;">Categoria</th>
                                <th style="text-align:left;padding:12px 10px;border-bottom:1px solid var(--border);color:#334155;">Quantidade</th>
                                <th style="text-align:left;padding:12px 10px;border-bottom:1px solid var(--border);color:#334155;">Preço</th>
                                <th style="text-align:left;padding:12px 10px;border-bottom:1px solid var(--border);color:#334155;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($resultado && $resultado->num_rows > 0): ?>
                                <?php while ($row = $resultado->fetch_assoc()): ?>
                                    <tr>
                                        <td style="padding:12px 10px;border-bottom:1px solid rgba(15,23,42,0.06);">#<?php echo (int)$row['id']; ?></td>
                                        <td style="padding:12px 10px;border-bottom:1px solid rgba(15,23,42,0.06);"><?php echo htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td style="padding:12px 10px;border-bottom:1px solid rgba(15,23,42,0.06);"><?php echo htmlspecialchars($row['categoria'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td style="padding:12px 10px;border-bottom:1px solid rgba(15,23,42,0.06);"><?php echo (int)$row['quantidade']; ?></td>
                                        <td style="padding:12px 10px;border-bottom:1px solid rgba(15,23,42,0.06);">R$ <?php echo number_format((float)$row['preco'], 2, ',', '.'); ?></td>
                                        <td style="padding:12px 10px;border-bottom:1px solid rgba(15,23,42,0.06);">
                                            <a
                                                href="editar-produto.php?id=<?php echo (int)$row['id']; ?>"
                                                class="btn"
                                                style="padding:10px 18px;text-decoration:none;"
                                            >
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="padding:16px 10px;color:var(--muted);">
                                        Nenhum produto cadastrado ainda.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
                    <a href="index.php" class="btn btn-primary" style="text-decoration:none;">Cadastrar novo produto</a>
                </div>

            </section>
        </main>

        <footer class="footer">Sistema de supermercado • Layout limpo e responsivo</footer>
    </div>

    <script src="index.js"></script>
</body>
</html>
