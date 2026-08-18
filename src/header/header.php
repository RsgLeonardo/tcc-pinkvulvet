<?php
require_once __DIR__ . '/../../../config/conect.php';
require_once __DIR__ . '/../cadastro-login/login/auth.php';

$esta_logado = verificar_login();
error_log("PHP: \$esta_logado é: " . ($esta_logado ? 'true' : 'false')); // Adicione esta linha para depuração
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>| Brasil</title>
  <link rel="shortcut icon" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/PV.png" type="image/x-icon">
  <link rel="stylesheet" href="estilos/style.css" class="css">
  <style>
    /* bugado qd tiro daq e coloco nos estilos */
    #mobile-menu {
      transition: transform 0.3s ease-in-out;
      transform: translateX(-100%);
    }

    #mobile-menu.open {
      transform: translateX(0);
    }

    /* Transição suave para o overlay */
    #overlay {
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 0.1);
      /* Fundo mais claro */
      backdrop-filter: blur(6px);
      /* Aplica o desfoque */
      z-index: 40;
      pointer-events: none;
      transition: opacity 0.3s ease-in-out;
      opacity: 0;
    }

    #overlay.open {
      opacity: 1;
    }

    /* Estilo para o campo de busca - CORRIGIDO */
    #search-container {
      width: 0;
      overflow: hidden;
      transition: width 0.3s ease-in-out;
      display: flex;
      align-items: center;
    }

    #search-container.open {
      width: 200px;
    }

    /* Estilo para o input de busca */
    #search-input {
      opacity: 0;
      transition: opacity 0.2s ease-in-out;
      border: 1px solid #e5e7eb;
      border-radius: 0.375rem;
      padding: 0.5rem;
      width: 100%;
      font-size: 0.875rem;
      margin-right: 0.25rem;
    }

    #search-input:focus {
      border: 1.5px solidrgb(163, 163, 163) !important;
      outline: none !important;
    }

    #search-input.visible {
      opacity: 1;
    }

    /* Estilo para o botão de submit da busca */
    #search-submit-button {
      opacity: 0;
      transition: opacity 0.2s ease-in-out;
      background: none;
      border: none;
      padding: 0.5rem;
      cursor: pointer;
      color: #6b7280;
    }

    #search-submit-button.visible {
      opacity: 1;
    }

    /* Estilo para o formulário de busca */
    .search-form {
      display: flex;
      align-items: center;
      width: 100%;
    }

    .op {
      opacity: 70%;
    }

    .logo-1 {
      width: 200px;
      height: auto;
    }

    .nav-grid {
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      width: 100%;
      align-items: center;
    }

    .nav-left {
      justify-self: start;
    }

    .nav-center {
      justify-self: center;
      padding: 0 10px;
      min-width: 200px;
      text-align: center;
    }

    .nav-right {
      justify-self: end;
      display: flex;
      flex-wrap: nowrap;
    }

    @media (max-width: 640px) {
      .nav-grid {
        grid-template-columns: auto auto auto;
      }

      .logo-1 {
        width: 150px;
      }
    }

    #hamburger-button {
      opacity: 70%;
    }

    .roboto {
      font-family: "Roboto", sans-serif;
      font-optical-sizing: auto;
      font-weight: 400;
      font-style: normal;
      font-variation-settings:
        "wdth" 100;
    }

    .p-4 {
      padding: 18.4px !important;
    }

    .hv-mia:hover {
      background-color: #f5f5f5;
    }

    .tamanha {
      height: 61px !important;
    }

    /* Estilo para o container do carrinho */
    .cart-container {
      position: relative;
      display: inline-block;
    }

    /* Estilo para o contador do carrinho - CORRIGIDO */
    .cart-count {
      background-color: #dc2626; /* Cor vermelha mais moderna */
      color: white;
      font-size: 0.65rem; /* Fonte menor para melhor proporção */
      font-weight: 600; /* Fonte mais forte */
      border-radius: 50%;
      width: 18px;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      top: -8px; /* Posição mais acima */
      right: -8px; /* Posição mais à direita */
      min-width: 18px;
      line-height: 1;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3); /* Sombra sutil */
      border: 2px solid white; /* Borda branca para destacar */
      z-index: 10; /* Garante que fica acima do ícone */
    }

    /* Esconde o contador quando não há itens */
    .cart-count.hidden {
      display: none !important;
    }
  </style>

<body>
  <?php
  $basePath = dirname($_SERVER['SCRIPT_NAME']); // Obtém o diretório atual do script que incluiu o menu
  ?>

  <nav class="fixed top-0 w-full z-50 flex items-center justify-between px-4 py-4 bg-white shadow-sm tamanha"
    style="background-color:rgb(255, 255, 255) !important"> <!--#fffafa-->
    <!-- Menu hambúrguer (lado esquerdo) -->
    <div class="flex items-center">
      <button id="hamburger-button" class="focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
          stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <!-- Logo  -->
    <div class="flex justify-center absolute left-1/2 transform -translate-x-1/2">
      <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/index.php">
        <img
          src="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/fotos/logo/logo-nova.svg"
          alt="" class="logo-1">
      </a>
    </div>


    <!-- Ícones (lado direito) -->
    <div class="flex items-center space-x-4">
      <!-- Ícone de pesquisa com campo de busca -->
      <div class="flex items-center">
        <button id="search-button" class="focus:outline-none op">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
          </svg>
        </button>
        <div class="search-container" id="search-container">
          <form action="/pinkvulvet/aplicacao/src/busca/result_busca_form.php" method="GET" class="search-form" id="search-form">
            <input type="text" name="termo_busca" class="search-input" id="search-input" placeholder="Buscar produtos..." autocomplete="off">
            <button type="submit" class="search-button" id="search-submit-button">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </div>
      </div>

      <!-- Favoritos -->
      <a
        href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/favoritos/favoritos.php">
        <button class="focus:outline-none op">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="1.5" style="display: inline-block !important;">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
        </button>
      </a>

      <!-- Carrinho com contador -->
      <div class="cart-container">
        <a
          href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/carrinho/carrinho.php">
          <button class="focus:outline-none op">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              stroke-width="1.5" style="display: inline-block !important;">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
          </button>
        </a>
        <span id="cart-item-count" class="cart-count hidden">0</span>
      </div>

      <!-- Ícone de conta de usuário -->
      <a id="opcoesLink"
        href="/pinkvulvet/aplicacao/src/conta/opcoes.php">
        <button class="focus:outline-none op">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="1.5" style="display: inline-block !important;">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
          </svg>
        </button>
      </a>
      <a id="meuPerfilLink"
        href="/pinkvulvet/aplicacao/src/minha-conta/minha_conta_form.php">
        <button class="focus:outline-none op">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="1.5" style="display: inline-block !important;">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
          </svg>
        </button>
      </a>
    </div>
  </nav>

  <!-- Menu lateral (inicialmente fora da tela, mas não oculto) -->
  <div id="mobile-menu" class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-50">
    <div class="flex flex-col h-full">
      <!-- Cabeçalho do menu lateral com botão fechar -->
      <div class="flex items-center justify-between p-4 border-b">
        <h2 class="text-lg font-medium"></h2>
        <button id="close-menu" class="focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Conteúdo do menu -->
      <div class="roboto p-4 overflow-y-auto flex-1">
        <ul class="space-y-6">
          <li active class="hv-mia"><a
              href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/index.php"
              class="block py-2">Inicio</a></li>

          <li class="hv-mia"><a
              href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/bases/produtos.php"
              class="block py-2">Face</a></li>

          <li class="hv-mia"><a
              href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/labios/labios.php"
              class="block py-2">Lábios</a></li>

          <li class="hv-mia"><a
              href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/olhos/olhos.php"
              class="block py-2">Olhos</a></li>

          <li class="hv-mia"><a
              href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/sobrancelhas/sobrancelhas.php"
              class="block py-2">Sobrancelhas</a></li>

          <li class="hv-mia"><a
              href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/perfumaria/perfumaria.php"
              class="block py-2">Perfumaria</a></li>

          <li class="hv-mia"><a
              href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/acessorios/acessorios.php"
              class="block py-2">Acessórios</a></li>
        </ul>
      </div>

      <!-- Rodapé do menu -->
      <div class="border-t p-4">
          <div id="loginStatusLinks" class="flex flex-col space-y-2">
            <a id="minhaContaLink" href="/pinkvulvet/aplicacao/src/minha-conta/minha_conta_form.php" class="text-sm text-gray-600 hover:text-black hidden">Minha Conta</a>
            <a id="sairLink" href="/pinkvulvet/aplicacao/src/cadastro-login/login/logout.php" class="text-sm text-gray-600 hover:text-black hidden">Sair</a>
            <a id="loginCadastroLink" href="/pinkvulvet/aplicacao/src/conta/opcoes.php" class="text-sm text-gray-600 hover:text-black hidden">Login / Cadastre-se</a>
          </div>
        </div>
    </div>
  </div>

  <!-- Fundo semitransparente (overlay) -->
  <div id="overlay" class="fixed inset-0 bg-black bg-opacity-80 z-40 pointer-events-none"></div>


  <script>
    // Funções
    // Variável JavaScript que recebe o status do PHP
    const userIsLoggedIn = <?php echo $esta_logado ? 'true' : 'false'; ?>;
    console.log('Usuário está logado:', userIsLoggedIn);

    const minhaContaLink = document.getElementById('minhaContaLink');
    const sairLink = document.getElementById('sairLink');
    const loginCadastroLink = document.getElementById('loginCadastroLink');
    const meuPerfilLinkTopNav = document.getElementById('meuPerfilLink');
    const opcoesLinkTopNav = document.getElementById('opcoesLink');
    const cartItemCountSpan = document.getElementById('cart-item-count'); // Definindo a variável aqui

    if (userIsLoggedIn) {
      // Se o usuário está logado, mostra "Minha Conta" e "Sair" na barra lateral
      minhaContaLink.classList.remove('hidden');
      sairLink.classList.remove('hidden');
      // Oculta "Login / Cadastre-se" na barra lateral
      loginCadastroLink.classList.add('hidden');

      // Para a navegação superior, mostra o ícone "Minha Conta" e oculta o ícone "Login / Cadastre-se"
      meuPerfilLinkTopNav.classList.remove('hidden');
      opcoesLinkTopNav.classList.add('hidden');
    } else {
      // Se o usuário NÃO está logado, mostra "Login / Cadastre-se" na barra lateral
      loginCadastroLink.classList.remove('hidden');
      // Oculta "Minha Conta" e "Sair" na barra lateral
      minhaContaLink.classList.add('hidden');
      sairLink.classList.add('hidden');

      // Para a navegação superior, mostra o ícone "Login / Cadastre-se" e oculta o ícone "Minha Conta"
      opcoesLinkTopNav.classList.remove('hidden');
      meuPerfilLinkTopNav.classList.add('hidden');
    }

    // Selecionar elementos
    const hamburgerButton = document.getElementById('hamburger-button');
    const closeMenuButton = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('overlay');

    // Elementos da busca
    const searchButton = document.getElementById('search-button');
    const searchContainer = document.getElementById('search-container');
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const searchSubmitButton = document.getElementById('search-submit-button');

    // Função para bloquear scroll do body quando o menu está aberto
    function lockBodyScroll() {
      document.body.style.overflow = 'hidden';
      document.body.style.touchAction = 'none';
    }

    // Função para desbloquear scroll do body quando o menu está fechado
    function unlockBodyScroll() {
      document.body.style.overflow = '';
      document.body.style.touchAction = '';
    }

    // Abrir menu com animação
    hamburgerButton.addEventListener('click', function() {
      overlay.classList.add('open');
      lockBodyScroll();
      setTimeout(() => {
        mobileMenu.classList.add('open');
      }, 50);
      closeSearch();
    });

    // Função para fechar o menu com animação
    function closeMenuWithAnimation() {
      mobileMenu.classList.remove('open');
      unlockBodyScroll();
      setTimeout(() => {
        overlay.classList.remove('open');
      }, 200);
    }

    // Fechar menu 
    closeMenuButton.addEventListener('click', closeMenuWithAnimation);
    overlay.addEventListener('click', closeMenuWithAnimation);

    // Fechar menu quando clicar em qualquer lugar da tela
    document.addEventListener('click', function(event) {
      if (mobileMenu.classList.contains('open')) {
        if (!mobileMenu.contains(event.target) &&
          event.target !== hamburgerButton &&
          !hamburgerButton.contains(event.target)) {
          closeMenuWithAnimation();
        }
      }
    });

    // Controle do campo de busca
    let searchOpen = false;

    function openSearch() {
      searchContainer.classList.add('open');
      setTimeout(() => {
        searchInput.classList.add('visible');
        searchSubmitButton.classList.add('visible');
        searchInput.focus();
      }, 150);
      searchOpen = true;
    }

    function closeSearch() {
      searchInput.classList.remove('visible');
      searchSubmitButton.classList.remove('visible');
      setTimeout(() => {
        searchContainer.classList.remove('open');
      }, 200);
      searchOpen = false;
    }

    searchButton.addEventListener('click', function(e) {
      e.stopPropagation();
      if (searchOpen) {
        closeSearch();
      } else {
        openSearch();
      }
    });

    document.addEventListener('click', function(event) {
      if (searchOpen &&
        !searchContainer.contains(event.target) &&
        !searchButton.contains(event.target)) {
        closeSearch();
      }
    });

    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape' && searchOpen) {
        closeSearch();
      }
    });

    if (searchForm) {
      searchForm.addEventListener('submit', function(event) {
        closeSearch();
      });
    }

    // navbar ativa 
    document.querySelectorAll('li a').forEach(link => {
      if (link.href === window.location.href) {
        link.classList.add('underline');
      }
    });

    // Substitua o código JavaScript no final do header.php por este:

    // Função para buscar a contagem de itens do carrinho - MELHORADA
    function fetchCartItemCount() {
        const baseUrl = '<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/';
        
        return fetch(baseUrl + 'aplicacao/src/carrinho/get_cart_count.php') // Caminho para o seu get_cart_count.php
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Dados recebidos do carrinho:', data);
                
                if (cartItemCountSpan && data.count !== undefined) { // Verifica se o span existe e se a contagem foi recebida
                    const count = parseInt(data.count);
                    cartItemCountSpan.textContent = count;
                    
                    if (count > 0) {
                        cartItemCountSpan.classList.remove('hidden');
                    } else {
                        cartItemCountSpan.classList.add('hidden');
                    }
                    
                    console.log('Contador atualizado para:', count);
                    return count;
                }
            })
            .catch(error => {
                console.error('Erro ao buscar contagem do carrinho:', error);
                if (cartItemCountSpan) {
                    cartItemCountSpan.classList.add('hidden'); // Esconde se houver erro ou problema de rede
                }
                return 0;
            });
    }

    // Função para atualizar o contador com animação
    function updateCartCountWithAnimation() {
        if (!cartItemCountSpan) return; // Garante que o elemento existe
        const cartIcon = cartItemCountSpan.parentElement; // O elemento pai do span (o link <a> ou a div 'cart-container')
        
        // Adiciona uma pequena animação de "pulse" para indicar atualização
        cartIcon.style.transition = 'transform 0.15s ease-in-out'; // Garante que a transição seja suave
        cartIcon.style.transform = 'scale(1.1)'; // Aumenta o tamanho
        setTimeout(() => {
            cartIcon.style.transform = 'scale(1)'; // Retorna ao tamanho normal
            cartIcon.style.transition = ''; // Remove a transição para não afetar outros estilos
        }, 150);
        
        fetchCartItemCount(); // Busca e atualiza a contagem real
    }

    // Função para detectar mudanças no localStorage (se usado)
    function watchCartChanges() {
        window.addEventListener('storage', function(e) {
            if (e.key === 'cart_items' || e.key === 'cart_count') {
                fetchCartItemCount();
            }
        });
    }

    // Função para atualizar o contador periodicamente (se necessário, geralmente não para eventos diretos)
    function startCartCountUpdater() {
        setInterval(fetchCartItemCount, 10000); // A cada 10 segundos
    }

    // Sistema de eventos customizados para atualização do carrinho
    document.addEventListener('cartUpdated', function() {
        updateCartCountWithAnimation();
    });

    // Função global para ser chamada quando itens são adicionados/removidos
    // Esta é a função que será chamada das suas páginas de produto (exibicao-produto.php, labios.php)
    window.updateCartCount = function() {
        updateCartCountWithAnimation();
    };

    // Função para monitorar mudanças via AJAX (parece duplicar 'updateCartCount' se for chamada por outros JS)
    window.onCartChange = function() {
        fetchCartItemCount();
    };

    // Chama as funções ao carregar a página
    document.addEventListener('DOMContentLoaded', function() {
        fetchCartItemCount(); // Atualiza a contagem inicial ao carregar a página
        // watchCartChanges(); // Ative se usa localStorage para o carrinho
        // startCartCountUpdater(); // Ative se quiser atualizações periódicas
    });

    // As funções addToCartAndUpdate e removeFromCartAndUpdate provavelmente
    // já estão definidas aqui. Se não estiverem, devem ser adicionadas.
    // Exemplo (se elas chamam `add_to_cart.php` ou `remove_from_cart.php`):
    window.addToCartAndUpdate = function(productId, quantity = 1) {
        const baseUrl = '<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/';
        
        return fetch(baseUrl + 'aplicacao/src/carrinho/add_to_cart.php', { // Este é o endpoint que esta função usa
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCountWithAnimation();
                document.dispatchEvent(new CustomEvent('cartUpdated', {
                    detail: { productId, quantity, action: 'add' }
                }));
            }
            return data;
        });
    };

    window.removeFromCartAndUpdate = function(productId) {
        const baseUrl = '<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/';
        
        return fetch(baseUrl + 'aplicacao/src/carrinho/remove_from_cart.php', { // Este é o endpoint que esta função usa
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCountWithAnimation();
                document.dispatchEvent(new CustomEvent('cartUpdated', {
                    detail: { productId, action: 'remove' }
                }));
            }
            return data;
        });
    };
  </script>

</body>

</html>