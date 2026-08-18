<?php
$basePath = dirname($_SERVER['SCRIPT_NAME']); // Obtém o diretório atual do script que incluiu o menu
?>

<style>
    .hover:hover {
        color: rgb(128, 128, 128) !important;
    }

    .hover {
        color: rgb(0, 0, 0) !important;
    }
</style>

<div style="margin-top: 70px !important;">
    <div class="pt-6">
        <nav aria-label="Breadcrumb">
            <ol role="list" class="max-w-2xl mx-auto px-4 flex items-center space-x-2 sm:px-6 lg:max-w-7xl lg:px-8">
                <li>
                    <div class="flex items-center">
                        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/index.php" class="hover mr-2 text-sm text-gray-900">Início</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li>

                    <div class="flex items-center">
                        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/minha-conta/minha_conta_form.php" class="hover mr-2 text-sm   text-gray-900">Minha Conta</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</div>

<script>
    // Script para diferenciar o item ativo
    document.addEventListener('DOMContentLoaded', function() {
        // Pega todos os itens do breadcrumb
        const breadcrumbItems = document.querySelectorAll('nav[aria-label="Breadcrumb"] ol li');

        if (breadcrumbItems.length === 0) return;

        // Pega a URL atual para comparação
        const currentUrl = window.location.href;

        // Remove a última seta divisória (do último item)
        const lastItem = breadcrumbItems[breadcrumbItems.length - 1];
        const lastSvg = lastItem.querySelector('svg');
        if (lastSvg) {
            lastSvg.remove();
        }

        // Percorre todos os itens do breadcrumb
        breadcrumbItems.forEach(item => {
            const link = item.querySelector('a');
            if (!link) return;

            // Verifica se o link corresponde à URL atual
            if (currentUrl.includes(link.getAttribute('href'))) {
                // Marca o item como ativo
                item.classList.add('active');

                // Destaca o link com cor rosa e negrito
                link.classList.add('hover', 'font-bold');
                link.classList.remove('text-gray-900');
            }
        });

        // Abordagem alternativa: identificar a página atual pelo caminho
        const pageIdentifiers = {
            'index.php': 'Início',
            'produtos.php': 'Face',
            'labios.php': 'Lábios',
            'olhos.php': 'Olhos',
            'sobrancelhas.php': 'Sobrancelhas',
            'perfumaria.php': 'Perfumaria',
            'acessorios.php': 'Acessórios'
        };

        // Identifica a página atual pelo caminho
        const currentPage = Object.keys(pageIdentifiers).find(page =>
            currentUrl.includes(page)
        );

        if (currentPage) {
            const currentCategory = pageIdentifiers[currentPage];

            // Encontra e marca o item correspondente
            breadcrumbItems.forEach(item => {
                const link = item.querySelector('a');
                if (link && link.textContent.trim() === currentCategory) {
                    item.classList.add('active');
                    link.classList.add('font-bold');
                    link.classList.remove('text-gray-900');
                }
            });
        }
    });
</script>