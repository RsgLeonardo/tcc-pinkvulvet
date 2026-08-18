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

<div class="bg-white" style="margin-top: 100px;">
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
                        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/bases/produtos.php" class="hover mr-2 text-sm   text-gray-900">Face</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/labios/labios.php" class="hover mr-2 text-sm   text-gray-900">Lábios</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/olhos/olhos.php" class="hover mr-2 text-sm   text-gray-900">Olhos</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/sobrancelhas/sobrancelhas.php" class="hover mr-2 text-sm   text-gray-900">Sobrancelhas</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/perfumaria/perfumaria.php" class="hover mr-2 text-sm   text-gray-900">Perfumaria</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/pinkvulvet/aplicacao/src/acessorios/acessorios.php" class="hover mr-2 text-sm   text-gray-900">Acessórios</a>
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
    document.addEventListener('DOMContentLoaded', function() {
        const breadcrumbItems = document.querySelectorAll('nav[aria-label="Breadcrumb"] ol li');
        if (breadcrumbItems.length === 0) return;

        const currentUrl = window.location.href;
        const urlParams = new URLSearchParams(window.location.search);

        // Remove a última seta divisória (do último item)
        const lastItem = breadcrumbItems[breadcrumbItems.length - 1];
        const lastSvg = lastItem.querySelector('svg');
        if (lastSvg) {
            lastSvg.remove();
        }

        // Função para obter categoria do produto (se estiver na página de exibição)
        function getCategoriaFromProduct() {
            // Se existe uma variável global categoria_produto definida no PHP
            if (typeof window.categoria_produto !== 'undefined') {
                return window.categoria_produto;
            }
            
            // Alternativa: tentar obter do parâmetro categoria na URL
            const categoria = urlParams.get('categoria');
            if (categoria) {
                return categoria;
            }
            
            return null;
        }

        // Mapeamento simplificado de categorias
        const categoryMap = {
            'index.php': 'Início',
            'produtos.php': 'Face',
            'bases/': 'Face',
            'labios.php': 'Lábios',
            'labios/': 'Lábios',
            'olhos.php': 'Olhos',
            'olhos/': 'Olhos',
            'sobrancelhas.php': 'Sobrancelhas',
            'sobrancelhas/': 'Sobrancelhas',
            'perfumaria.php': 'Perfumaria',
            'perfumaria/': 'Perfumaria',
            'acessorios.php': 'Acessórios',
            'acessorios/': 'Acessórios'
        };

        let activeCategory = null;

        // Se estamos na página de exibição de produto, obter categoria do produto
        if (currentUrl.includes('exibicao-produto.php')) {
            activeCategory = getCategoriaFromProduct();
            
            // Mapear nomes de categoria do banco para labels do breadcrumb
            const categoryMapping = {
                'face': 'Face',
                'bases': 'Face',
                'labios': 'Lábios',
                'olhos': 'Olhos',
                'sobrancelhas': 'Sobrancelhas',
                'perfumaria': 'Perfumaria',
                'acessorios': 'Acessórios'
            };
            
            if (activeCategory && categoryMapping[activeCategory.toLowerCase()]) {
                activeCategory = categoryMapping[activeCategory.toLowerCase()];
            }
        } else {
            // Para outras páginas, usar o mapeamento baseado na URL
            for (const [urlPart, category] of Object.entries(categoryMap)) {
                if (currentUrl.toLowerCase().includes(urlPart.toLowerCase())) {
                    activeCategory = category;
                    break;
                }
            }
        }

        // Marcar o item correspondente como ativo
        if (activeCategory) {
            breadcrumbItems.forEach(item => {
                const link = item.querySelector('a');
                if (link && link.textContent.trim() === activeCategory) {
                    item.classList.add('active');
                    link.classList.add('text-pink-500', 'font-bold');
                    link.classList.remove('text-gray-900');
                }
            });
        }
    });
</script>