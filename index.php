<?php include 'aplicacao/src/header/header.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>| Brasil</title>
    <script src="https://cdn.tailwindcss.com "></script>
    <link rel="shortcut icon" href="fotos/logo/PV.png" type="image/x-icon">
    <style>
        /* Tailwind-like minimal styles for demo if Tailwind not included */
        .dark\:bg-gray-800 {
            background-color: #2d3748;
        }

        .dark\:text-white {
            color: white;
        }

        .focus\:outline-none:focus {
            outline: none;
        }

        .focus\:ring-2:focus {
            box-shadow: 0 0 0 2px rgba(160, 160, 160, 0.6);
        }

        .focus\:ring-offset-2:focus {
            outline-offset: 2px;
        }

        .focus\:ring-gray-400:focus {
            box-shadow: 0 0 0 2px #cbd5e0;
        }

        .bottom-4 {
            bottom: 1rem;
        }

        .z-10 {
            z-index: 10;
        }

        .absolute {
            position: absolute;
        }

        .text-base {
            font-size: 1rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .leading-none {
            line-height: 1;
        }

        .text-gray-800 {
            color: #1a202c;
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .w-36 {
            width: 9rem;
        }

        .bg-white {
            background-color: white;
        }

        a.button-link {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            cursor: pointer;
        }

        .px-20 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .xl {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .mais {
            padding-left: 0 !important;
        }

        /* Previne overflow horizontal */
        body {
            overflow-x: hidden;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        /* .h-screen {
        height: 50vh !important;
        } */
        .video-container iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Animações de scroll */
        .scroll-animate {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .scroll-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-animate-left {
            opacity: 0;
            transform: translateX(-80px);
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .scroll-animate-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-animate-right {
            opacity: 0;
            transform: translateX(80px);
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .scroll-animate-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-animate-scale {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .scroll-animate-scale.visible {
            opacity: 1;
            transform: scale(1);
        }

        /* Cor de fundo bege suave que combina com as imagens */
        .bg-warm-beige {
            background-color: #f8f5f0;
        }

        /* Animação sutil de flutuação para o perfume */
        .perfume-float {
            animation: subtleFloat 4s ease-in-out infinite;
            transform-origin: center;
        }

        @keyframes subtleFloat {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* Efeito parallax muito sutil */
        .subtle-parallax {
            transition: transform 0.1s ease-out;
        }

        /* Animação de fade gradual */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 1.2s ease-out;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animação para os números das estatísticas */
        .counter-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .counter-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animação de contagem dos números */
        .number-counter {
            transition: all 0.3s ease;
        }

        /* Animação suave para a logo */
        .logo-fade {
            opacity: 0;
            transform: scale(0.9);
            transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .logo-fade.visible {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>

<body class="bg-white">


    <!-- Seção de Fundo -->
    <section id="banner" class="relative flex items-center justify-center overflow-hidden">
        <!-- Container para manter a imagem e o texto juntos -->
        <div class="relative w-full" style="width: 100%; max-width: 3000px; aspect-ratio: 3000/1081;">
            <!-- Imagem no tamanho original -->
            <img src="fotos/pag-inicial/banner-otz.png" alt="Banner" class="absolute inset-0 w-full h-full" style="z-index: 0;" />

            <!-- Conteúdo posicionado dentro da imagem -->
            <div class="absolute bottom-4 left-0 right-0 z-10 text-white text-center">
                <a class="button-link hover:underline" style="padding: 10px; color: black;" href="#perfume-grande">Saiba Mais</a>
            </div>
        </div>
    </section>

    <!-- Seção Categorias (corrigida) -->
    <h2 class="mt-10 text-center text-4xl font-light text-gray-800 scroll-animate">Categorias</h2>

    <div class="bg-white">
        <section id="categorias" class="container mx-auto px-4 py-12 bg-white max-w-screen-xl">
            <div class="flex justify-center items-center">
                <div class="w-full">
                    <div class="flex flex-col items-center space-y-10">

                        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-6 w-full">

                            <!-- COLUNA 1 -->
                            <div class="flex flex-col space-y-6 scroll-animate-left">
                                <!-- imagem 1 -->
                                <div class="relative group flex justify-center items-center w-full overflow-hidden">
                                    <img class="object-cover w-full h-auto" src="fotos/categorias/base-up.png" alt="categoria face" />
                                    <a href="aplicacao/src/bases/produtos.php" class="button-link text-black bottom-4 z-10 absolute font-medium leading-none py-3 w-36 
                                    bg-white bg-opacity-50 backdrop-blur-md text-black font-semibold hover:bg-opacity-100 transition">
                                        Face
                                    </a>
                                </div>
                                <!-- imagem 2 -->
                                <div class="relative group flex justify-center items-center w-full overflow-hidden">
                                    <img class="object-cover w-full h-auto" src="fotos/categorias/gloss-up.png" alt="categoria labios" />
                                    <a href="aplicacao/src/labios/labios.php" class="button-link text-black bottom-4 z-10 absolute font-medium leading-none py-3 w-36 
                                    bg-white bg-opacity-50 backdrop-blur-md text-black font-semibold hover:bg-opacity-100 transition">
                                        Lábios
                                    </a>
                                </div>
                            </div>

                            <!-- COLUNA 2 -->
                            <div class="flex flex-col space-y-6 scroll-animate-scale">
                                <!-- imagem 3 -->
                                <div class="relative group flex justify-center items-center w-full overflow-hidden">
                                    <img class="object-cover w-full h-auto" src="fotos/categorias/rimel-up.png" alt="categoria olhos" />
                                    <a href="aplicacao/src/olhos/olhos.php" class="button-link text-black bottom-4 z-10 absolute font-medium leading-none py-3 w-36 
                                    bg-white bg-opacity-50 backdrop-blur-md text-black font-semibold hover:bg-opacity-100 transition">
                                        Olhos
                                    </a>
                                </div>
                                <!-- imagem 4 -->
                                <div class="relative group flex justify-center items-center w-full overflow-hidden">
                                    <img class="object-cover w-full h-auto" src="fotos/categorias/sombra-up.png" alt="categoria sobrancelha" />
                                    <a href="aplicacao/src/sobrancelhas/sobrancelhas.php" class="button-link text-black bottom-4 z-10 absolute font-medium leading-none py-3 w-36 
                                    bg-white bg-opacity-50 backdrop-blur-md text-black font-semibold hover:bg-opacity-100 transition">
                                        Sobrancelhas
                                    </a>
                                </div>
                            </div>

                            <!-- COLUNA 3 -->
                            <div class="flex flex-col space-y-6 scroll-animate-right">
                                <!-- imagem 5 -->
                                <div class="relative group flex justify-center items-center w-full overflow-hidden">
                                    <img class="object-cover w-full h-auto" src="fotos/categorias/perfume-up.png" alt="categoria perfumaria" />
                                    <a href="aplicacao/src/perfumaria/perfumaria.php" class="button-link text-black bottom-4 z-10 absolute font-medium leading-none py-3 w-36 
                                    bg-white bg-opacity-50 backdrop-blur-md text-black font-semibold hover:bg-opacity-100 transition">
                                        Perfumaria
                                    </a>
                                </div>
                                <!-- imagem 6 -->
                                <div class="relative group flex justify-center items-center w-full overflow-hidden">
                                    <img class="object-cover w-full h-auto" src="fotos/categorias/pincel-up.png" alt="categoria acessorios" />
                                    <a href="aplicacao/src/acessorios/acessorios.php"
                                    class="button-link text-black bottom-4 z-10 absolute font-medium leading-none py-3 w-36 
                                    bg-white bg-opacity-50 backdrop-blur-md text-black font-semibold hover:bg-opacity-100 transition">
                                        Acessórios
                                    </a>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- perfume grande -->
    <section id="perfume-grande" class="bg-warm-beige py-16">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-12 fade-in-up">
                <p class="text-sm text-gray-600 mb-2">Feito Com Amor</p>
                <h2 class="text-4xl font-light text-gray-800">Presenteie Com PV</h2>
            </div>

            <div class="flex flex-wrap items-center max-w-7xl mx-auto">
                <!-- Imagem à esquerda -->
                <div class="w-full lg:w-1/2 px-4 fade-in-up">
                    <div class="relative subtle-parallax">
                        <a href="aplicacao/src/perfumaria/perfumaria.php">
                            <img src="fotos/pag-inicial/perfumin-1.png" alt="perfume" class="w-full h-auto perfume-float" id="perfume-image">
                        </a>
                    </div>
                </div>

                <!-- Grid de produtos à direita -->
                <div class="w-full lg:w-1/2 px-4 fade-in-up">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <p class="text-2xl text-gray-800 font-light text-center">Flor d'Élixir</p>
                        <p class="text-base text-gray-600 mb-2">É um perfume floral sofisticado que combina a delicadeza da peônia e frésia, um coração sedutor de rosa de damasco e jasmim árabe, e um fundo envolvente de baunilha e sândalo cremoso. A fragrância exala feminilidade, charme e elegância, deixando um rastro memorável e irresistível.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- perfume pequeno -->
    <section id="perfume-pequeno" class="bg-white flex justify-center items-center relative h-screen">
        <div class="relative scroll-animate-scale">
            <a href="aplicacao/src/perfumaria/perfumaria.php">
                <img src="fotos/pag-inicial/perfumin-4.png" alt="perfume" class="w-80 h-auto mx-auto">
            </a>
            <!-- Texto sobreposto -->
            <div class="absolute inset-0 flex flex-col justify-center items-center bg-black bg-opacity-50 text-white p-4">
                <h2 class="text-xl mb-2">Descubra o Encanto</h2>
                <p class="text-sm mb-4 text-center">Uma fragrância que envolve com sofisticação e charme.</p>
                <a href="aplicacao/src/exibicao/exibicao-produto.php?id=49">
                    <button class="px-6 py-3 bg-white bg-opacity-30 backdrop-blur-md text-white font-semibold hover:bg-opacity-50 transition">
                        Compre Agora
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- Seção de Tutoriais/Dicas -->
    <section id="tutorial" class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 scroll-animate">
                <p class="text-sm text-gray-600 mb-2">Aprenda Conosco</p>
                <h2 class="text-4xl font-light text-gray-800">Tutoriais & Dicas</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                <!-- Tutorial 1 -->
                <div class="bg-white overflow-hidden shadow-md card-hover scroll-animate-left">
                    <div class="relative w-full aspect-video">
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/UxQg3_Cmwhw?si=qbPlc4WJ5fXoE02x&amp;start=160"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-medium text-gray-800 mb-2">Maquiagem do anos '90s</h3>
                        <p class="text-gray-600 text-sm mb-4">Aprenda a criar uma maquiagem estilo anos '90s com a atriz Alexa Demie.</p>
                        <div class="flex items-center text-sm text-gray-500">
                        </div>
                    </div>
                </div>

                <!-- Tutorial 2 -->
                <div class="bg-white overflow-hidden shadow-md card-hover scroll-animate-right">
                    <div class="relative w-full aspect-video">
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/bEKufM_im88?si=CR-S70VQGrxRnBE7&amp;start=123" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-medium text-gray-800 mb-2">Maquiagem Natural</h3>
                        <p class="text-gray-600 text-sm mb-4">Aprenda a criar uma maquiagem natural para o dia a dia com Kylie Jenner.</p>
                        <div class="flex items-center text-sm text-gray-500">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <p style="margin-bottom: 112px;"></p>
    </section>

    <!-- Seção Sobre Nós -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 scroll-animate">
                <p class="text-sm text-gray-600 mb-2">Nossa História</p>
                <h2 class="text-4xl font-light text-gray-800">Sobre Nós</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <!-- Texto à esquerda -->
                <div class="w-full lg:w-1/2 pr-8 scroll-animate-left">
                    <div class="space-y-6">
                        <h3 class="text-2xl font-light text-gray-800">Beleza Autêntica, Cuidado Especial</h3>
                        <p class="text-gray-600 leading-relaxed"> Há mais de 10 anos, a PV nasceu com o propósito de realçar a beleza natural de cada mulher. Acreditamos que cada pessoa é única e merece produtos que reflitam sua personalidade e estilo. </p>
                        <p class="text-gray-600 leading-relaxed"> Nossa curadoria especial seleciona apenas os melhores produtos, desde perfumes exclusivos até maquiagens de alta qualidade. Cada item é escolhido pensando em você, com amor e dedicação. </p>
                        <div class="flex space-x-8 mt-8">
                            <div class="text-center counter-animate">
                                <div class="text-3xl font-light text-gray-400 number-counter" data-target="10">0</div>
                                <div class="text-sm text-gray-600">Anos de Experiência</div>
                            </div>
                            <div class="text-center counter-animate">
                                <div class="text-3xl font-light text-gray-400 number-counter" data-target="50">0</div>
                                <div class="text-sm text-gray-600">Clientes Satisfeitas</div>
                            </div>
                            <div class="text-center counter-animate">
                                <div class="text-3xl font-light text-gray-400 number-counter" data-target="200">0</div>
                                <div class="text-sm text-gray-600">Produtos Exclusivos</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Imagem à direita -->
                <div class="w-full lg:w-1/2 pl-8 mt-8 lg:mt-0 scroll-animate-right">
                    <div class="relative logo-fade">
                        <img src="fotos/logo/logo-nova.svg" alt="Sobre PV" class="w-full h-auto rounded-lg">
                        <div class="absolute inset-0 gradient-overlay rounded-lg opacity-20"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'aplicacao/src/footer/footer.php'; ?>

    <script>
        // Sistema de animações no scroll
        function initScrollAnimations() {
            const animatedElements = document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale, .fade-in-up, .counter-animate, .logo-fade');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');

                        // Se for um elemento contador, inicia a animação de contagem
                        if (entry.target.classList.contains('counter-animate')) {
                            const numberElement = entry.target.querySelector('.number-counter');
                            if (numberElement) {
                                animateCounter(numberElement);
                            }
                        }
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            animatedElements.forEach(el => observer.observe(el));
        }

        // Função para animar os números das estatísticas
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // 2 segundos
            const step = target / (duration / 16); // 60 FPS
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }

                // Formatação especial para números grandes
                if (target >= 1000) {
                    element.textContent = Math.floor(current / 1000) + 'k+';
                } else {
                    element.textContent = Math.floor(current) + '+';
                }
            }, 16);
        }

        // Efeito parallax muito sutil
        function initSubtleParallax() {
            const parallaxElements = document.querySelectorAll('.subtle-parallax');

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.005; // Muito mais sutil que antes

                parallaxElements.forEach(element => {
                    element.style.transform = `translateY(${rate}px)`;
                });
            });
        }

        // Animação suave do scroll interno dos links
        function initSmoothScroll() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }

        // Inicializar todas as animações quando a página carregar
        document.addEventListener('DOMContentLoaded', () => {
            initScrollAnimations();
            initSubtleParallax();
            initSmoothScroll();
        });
    </script>
</body>

</html>