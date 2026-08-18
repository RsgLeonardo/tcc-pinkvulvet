<?php require_once __DIR__ . '/result_busca.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' 'unsafe-eval';">
    <link href="../estilos/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <?php $basePath = dirname($_SERVER['SCRIPT_NAME']); ?>
    <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/principal.css">
    <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">
    <title>Resultados da Busca | Pink Vulvet</title>
</head>

<body>
    <?php include '../header/header.php'; ?>
    <?php include '../header/navbar.php'; ?>

    <!-- Mensagem de Sucesso -->
    <div id="successMessage" class="success-message" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
        background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; z-index: 9999;">
        ✅ Produto adicionado ao carrinho com sucesso!
    </div>

    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8" style="margin-top: -70px !important;">
            <!-- <h2 class="text-2xl roboto text-center">Resultados da Busca</h2> -->

            <?php if (!empty($termo_busca)): ?>
                <?php if (!empty($produtos_encontrados)): ?>
                    <p class="mt-2"></p>
                    <p class="text-gray-700 mb-6">Exibindo resultados para: <span class="font-semibold">"<?php echo htmlspecialchars($termo_busca); ?>"</span></p>
                    <div id="produtos-container" class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-5 xl:gap-x-8">
                        <?php foreach ($produtos_encontrados as $produto): ?>
                            <?php
                            $caminho_imagem = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/pinkvulvet/fotos/produtos/' . htmlspecialchars($produto['imagem']);
                            $link_produto = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/pinkvulvet/aplicacao/src/exibicao/exibicao-produto.php?id=' . $produto['id_produto'];
                            ?>
                            <div class="group relative">
                                <a href="<?php echo $link_produto; ?>">
                                    <img src="<?php echo $caminho_imagem; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                                </a>
                                <div class="mt-4 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-sm text-gray-700">
                                            <a href="<?php echo $link_produto; ?>" class="hover:underline"><?php echo htmlspecialchars($produto['nome']); ?></a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500"><b>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></b></p>
                                    </div>

                                    <form class="add-to-cart-form" method="POST">
                                        <input type="hidden" name="adicionar_carrinho" value="<?php echo $produto['id_produto']; ?>">
                                        <button type="submit" class="cursor-pointer mb-5">
                                            <img src="../../../fotos/produtos/carrinho.png" alt="Adicionar ao carrinho" class="w-6 h-6">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>


                <?php else: ?>
                    <div class="no-results text-center">
                        <p>Nenhum produto encontrado para: <span class="font-semibold">"<?php echo htmlspecialchars($termo_busca); ?>"</span></p>
                        <p>Tente buscar por termos diferentes ou verifique a ortografia.</p>
                        <a href="/pinkvulvet/index.php" class="btn-home mt-6 inline-block">Voltar para a Página Inicial</a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="no-results text-center">
                    <p>Por favor, digite um termo para buscar.</p>
                    <a href="/pinkvulvet/index.php" class="btn-home mt-6 inline-block">Voltar para a Página Inicial</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../footer/footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>