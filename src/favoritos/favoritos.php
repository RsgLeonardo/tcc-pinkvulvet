<?php require_once 'fav.php'; ?>
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
    <?php $basePath = dirname($_SERVER['SCRIPT_NAME']); // Obtém o diretório atual do script que incluiu o menu 
    ?>
    <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/principal.css">
    <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">
    <title>| Lista de Desejos</title>
    <style>
        html,
        body {
          height: 100%;
          margin: 0;
          padding: 0;
        }

        body {
          min-height: 100vh;
          display: flex;
          flex-direction: column;
        
        }
        
        .main-content {
          flex: 1;
        }
        /* Estilo para o ícone de favorito */
        .favorite-toggle-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5em;
            cursor: pointer;
            color: #ff0000;
            transition: color 0.2s ease-in-out;
            background: none;
            border: none;
            padding: 5px;
            z-index: 10;
            border-radius: 50%;
        }

        .favorite-toggle-btn:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .core-img {
            max-width: 100px;
            height: auto;
            margin-left: 0;
            padding-left: 10px !important;
            margin-top: -10px
        }

        /* CORREÇÃO ESPECÍFICA PARA NAVBAR EM FAVORITOS */
        nav[aria-label="Breadcrumb"] a {
            pointer-events: auto !important;
            cursor: pointer !important;
            text-decoration: none !important;
            color: rgb(0, 0, 0) !important;
            position: relative !important;
            z-index: 10 !important;
            display: inline-block !important;
            transform: none !important;
            filter: none !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        nav[aria-label="Breadcrumb"] a:hover {
            color: rgb(128, 128, 128) !important;
        }

        nav[aria-label="Breadcrumb"] * {
            pointer-events: auto !important;
        }

        nav[aria-label="Breadcrumb"] {
            position: relative !important;
            z-index: 5 !important;
        }

        nav[aria-label="Breadcrumb"] ol {
            position: relative !important;
            z-index: 6 !important;
        }

        nav[aria-label="Breadcrumb"] li {
            position: relative !important;
            z-index: 8 !important;
        }

        header {
            z-index: 9999 !important;
            position: relative !important;
        }

        .header,
        #header {
            z-index: 9999 !important;
            position: relative !important;
        }
    </style>
</head>

<body>
    <?php include '../header/header.php'; ?>
    <?php include '../header/navbar.php'; ?>
    <div class="main-content">
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8"
            style="margin-top: -70px !important;">
            <h2 class="text-2xl roboto">Lista de Desejos &hearts;</h2>

            <?php if (!empty($produtos_favoritos)): ?>
                <div id="produtos-container"
                    class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-5 xl:gap-x-8">
                    <?php foreach ($produtos_favoritos as $produto):
                        $caminho_imagem = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/pinkvulvet/fotos/produtos/' . htmlspecialchars($produto['imagem']);
                        $link_produto = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/pinkvulvet/aplicacao/src/exibicao/exibicao-produto.php?id=' . $produto['id_produto'];
                    ?>
                        <div class="group relative" data-product-id="<?php echo htmlspecialchars($produto['id_produto']); ?>">
                            <button type="button"
                                class="favorite-toggle-btn"
                                data-product-id="<?php echo htmlspecialchars($produto['id_produto']); ?>"
                                data-is-favorite="true">
                                <i class="fas fa-heart"></i>
                            </button>

                            <a href="<?php echo $link_produto; ?>">
                                <img src="<?php echo $caminho_imagem; ?>"
                                    alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                            </a>

                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <a href="<?php echo $link_produto; ?>" class="hover:underline">
                                            <?php echo htmlspecialchars($produto['nome']); ?>
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        <b>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></b>
                                    </p>
                                </div>
                                <form class="add-to-cart-form" method="POST">
                                    <input type="hidden" name="adicionar_carrinho" value="<?php echo $produto['id_produto']; ?>">
                                    <button type="submit" class="cursor-pointer">
                                        <img src="../../../fotos/produtos/carrinho.png" alt="Adicionar ao carrinho">
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- Quando não houver nenhum item nos favoritos isso aparece: -->
                <div id="fav-null" class="text-gray-800">
                    <br>
                    <div class="flex">
                        <h2 class="text-xl">Guarde seus favoritos com um clique!</h2>
                        <img class="core-img" src="../../../fotos/favoritos/gif-favoritos.gif" alt="">
                    </div>

                    <p>Salve tudo o que você ama em um só lugar.</p>
                    <br>
                    <p>
                        &hearts; Não perca os itens que conquistaram seu coração. <br>
                        &hearts; Acompanhe seus itens favoritos com facilidade.
                    </p>
                    <br>
                    <div class="">
                        <a class="hover:underline" href='/pinkvulvet/index.php' class=''><b>Explorar Produtos</b></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <?php include '../footer/footer.php'; ?>
    <script src="script.js"></script>

    <!-- Script adicional para garantir funcionamento da navbar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Força os links da navbar a funcionarem
            const navbarLinks = document.querySelectorAll('nav[aria-label="Breadcrumb"] a');
            navbarLinks.forEach(link => {
                link.style.pointerEvents = 'auto';
                link.style.cursor = 'pointer';
                link.style.zIndex = '10';

                // Remove qualquer event listener que possa estar bloqueando
                link.onclick = null;
            });

            // Garante que o header tenha z-index alto
            const header = document.querySelector('header');
            if (header) {
                header.style.zIndex = '9999';
                header.style.position = 'relative';
            }

            // Também verifica por classes comuns de header
            const headerElements = document.querySelectorAll('.header, #header, [class*="header"]');
            headerElements.forEach(el => {
                el.style.zIndex = '9999';
                el.style.position = 'relative';
            });

            console.log('Navbar links corrigidos:', navbarLinks.length);
            console.log('Header z-index ajustado');
        });
    </script>
</body>

</html>