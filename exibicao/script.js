document.addEventListener("DOMContentLoaded", function () {
    // Selecionar todos os botões de abas
    const tabBtns = document.querySelectorAll(".tab-btn");
  
    // Adicionar evento de clique a cada botão
    tabBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        // Remover classe ativa de todos os botões
        tabBtns.forEach((b) => {
          b.classList.remove("tab-active");
          b.classList.remove("border-black");
          b.classList.add("border-transparent");
        });
  
        // Adicionar classe ativa ao botão clicado
        this.classList.add("tab-active");
        this.classList.remove("border-transparent");
        this.classList.add("border-black");
  
        // Esconder todos os conteúdos de abas
        const tabContents = document.querySelectorAll(".tab-content");
        tabContents.forEach((content) => {
          content.classList.add("hidden");
        });
  
        // Mostrar o conteúdo da aba selecionada
        const tabId = this.getAttribute("data-tab");
        const selectedTab = document.getElementById(tabId);
        selectedTab.classList.remove("hidden");
        selectedTab.style.zIndex = "1";
      });
    });
  
    // Controle de quantidade
    const minusBtn = document.querySelector(".qty-btn.minus");
    const plusBtn = document.querySelector(".qty-btn.plus");
    const qtyInput = document.querySelector("#quantidade");
  
    minusBtn.addEventListener("click", function () {
      const currentValue = parseInt(qtyInput.value);
      if (currentValue > 1) {
        qtyInput.value = currentValue - 1;
      }
    });
  
    plusBtn.addEventListener("click", function () {
      const currentValue = parseInt(qtyInput.value);
      qtyInput.value = currentValue + 1;
    });
  
    // Lógica do Botão de Favoritar/Desfavoritar
    const favoriteButton = document.getElementById('heartIcon');
    const favoriteMessage = document.getElementById('favorite-message');
  
    if (favoriteButton) {
      // Aplicar o estado inicial do coração baseado nos dados do PHP
      const heartPath = favoriteButton.querySelector('path');
      const isInitiallyFavorited = favoriteButton.dataset.isFavorite === 'true';
      
      if (isInitiallyFavorited) {
        heartPath.setAttribute('fill', 'red');
        heartPath.setAttribute('stroke', 'red');
        favoriteButton.classList.add('favorited');
      } else {
        heartPath.setAttribute('fill', 'none');
        heartPath.setAttribute('stroke', 'currentColor');
        favoriteButton.classList.remove('favorited');
      }
  
      favoriteButton.addEventListener('click', async function() {
        const productId = this.dataset.productId;
        let isFavorited = this.dataset.isFavorite === 'true';
        const action = isFavorited ? 'desfavoritar' : 'favoritar';
        const heartPath = this.querySelector('path'); // Seleciona o path do SVG
  
        try {
          const response = await fetch('../favoritos/favoritar.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              id_produto: productId,
              acao: action
            })
          });
  
          const data = await response.json();
  
          if (data.success) {
            // Atualiza o visual do coração
            if (action === 'favoritar') {
              heartPath.setAttribute('fill', 'red');
              heartPath.setAttribute('stroke', 'red');
              this.dataset.isFavorite = 'true';
              this.classList.add('favorited');
            } else {
              heartPath.setAttribute('fill', 'none');
              heartPath.setAttribute('stroke', 'currentColor');
              this.dataset.isFavorite = 'false';
              this.classList.remove('favorited');
            }
  
            // Não exibe mensagem para operações bem-sucedidas
            console.log('Favorito atualizado:', data.message);
            
          } else {
            // Só exibe mensagem em caso de erro real (ex: não logado)
            if (favoriteMessage) {
              favoriteMessage.textContent = data.message;
              favoriteMessage.classList.remove('hidden');
              favoriteMessage.classList.add('show', 'error');
              
              // Se não estiver logado, redireciona
              if (data.message.includes('logado')) {
                setTimeout(() => {
                  window.location.href = '../conta/opcoes.php?redirect=' + encodeURIComponent(window.location.href);
                }, 1500);
              }
  
              setTimeout(() => {
                favoriteMessage.classList.remove('show');
                favoriteMessage.classList.add('hidden');
              }, 3000);
            }
          }
  
        } catch (error) {
          console.error('Erro ao favoritar/desfavoritar:', error);
          // Só exibe mensagem de erro se houver problema de comunicação real
          if (favoriteMessage) {
            favoriteMessage.textContent = 'Erro de comunicação. Tente novamente.';
            favoriteMessage.classList.remove('hidden');
            favoriteMessage.classList.add('show', 'error');
            
            setTimeout(() => {
              favoriteMessage.classList.remove('show');
              favoriteMessage.classList.add('hidden');
            }, 5000);
          }
        }
      });
    }
  });