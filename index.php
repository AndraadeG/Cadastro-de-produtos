<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Painel de Produtos</title>
    <link rel="stylesheet" href="index.css" />

</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <div class="branding">
                <p class="eyebrow">Painel de Cadastro</p>
                <h1>Cadastro de produtos</h1>
                <p class="subtitle">Organize o estoque com um fluxo simples e prático.</p>
            </div>
        </header>

        <main class="page-content">
            <section class="card form-card">
                <div class="card-header">
                    <h2>Novo produto</h2>
                    <p>Preencha os dados abaixo para incluir um item no estoque.</p>
                </div>

                <form action="cadastrar_produto.php" method="POST" class="product-form">
                    <div class="field">
                        <label for="nome">Nome do produto</label>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            placeholder="Ex: Arroz integral"
                            required
                        />
                    </div>

                    <div class="field">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" name="categoria">
                            <option value="Alimentos">Alimentos</option>
                            <option value="Bebidas">Bebidas</option>
                            <option value="Higiene">Higiene</option>
                            <option value="Limpeza">Limpeza</option>
                        </select>
                    </div>

                    <div class="field-group">
                        <div class="field">
                            <label for="quantidade">Quantidade</label>
                            <input
                                type="number"
                                id="quantidade"
                                name="quantidade"
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
                                placeholder="0.00"
                                min="0"
                                step="0.01"
                            />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar produto</button>
                    <div id="mensagem"></div>
                    <a href="produtos.php">
                        Ver produtos cadastrados
                    </a>
                </form>
            </section>

            <section class="card info-card">
                <h3>Bem-vindo ao sistema</h3>
                <p>Use o formulário para cadastrar produtos e mantenha o estoque sempre atualizado.</p>
                <ul class="tips">
                    <li>Escolha um nome claro e objetivo</li>
                    <li>Mantenha as categorias consistentes</li>
                    <li>Registre preço e quantidade corretamente</li>
                </ul>
                <p class="small-note">Veja os produtos cadastrados em <strong>produtos.php</strong> e altere-os em <strong>editar-produto.php</strong>.</p>
            </section>
        </main>

        <footer class="footer">Sistema de supermercado • Layout limpo e responsivo</footer>
    </div>      
    <script src="index.js"></script>
</body>
</html>