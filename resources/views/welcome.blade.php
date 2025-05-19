<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'public/css/welcome.css'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Add this before your closing head tag -->
    <script>
        // Check initial dark mode preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        /* Optional: Add a bit more styling for the carousel dots if needed */
        .carousel-dot {
            cursor: pointer;
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .carousel-dot.active {
            background-color: #007bff; /* Or your theme's primary color */
        }

        .dark .carousel-dot.active {
            background-color: #3b82f6; /* A blue that works in dark mode */
        }

        .dark .carousel-dot {
            background-color: #4b5563; /* Darker inactive dot */
        }

        .product-item { /* Added class to style each individual product container*/
            transition: opacity 0.5s ease; /* Add a smooth transition */
            opacity: 1;
        }

        .product-item.fade-out {
            opacity: 0;
        }

        .product-item.fade-in {
            opacity: 1;
        }

        .product-name-overlay {
            font-size: 1.2rem; /* Adjust text size */
            font-weight: bold;
            padding: 0.5rem; /* Adjust padding */
            background-color: rgba(0, 0, 0, 0.6); /* Adjust opacity */
        }

        /* Adjust image height for all product boxes */
        .product-image {
            height: 210px; /* Taller boxes, 5% increase */
        }

    </style>
</head>
<body class="antialiased">
<!-- Navigation -->
<nav class="nav-gradient">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between nav-content">
            <!-- Logo -->
            <div class="nav-logo">
                <img src="{{ asset('images/logo_white_footer.png') }}" alt="Tri Color Design" class="w-48">
            </div>

            <!-- Contact Info -->
            <div class="nav-contact flex items-center space-x-6 text-white">
                <div class="flex items-center">
                    <i class="fas fa-envelope mr-2"></i>
                    <span>tricolor@gmail.com</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-phone mr-2"></i>
                    <span>+258 84 427 8012</span>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button class="bg-blue-500 bg-opacity-50 text-white px-6 py-2 rounded-md hover:bg-opacity-75 transition">
                PRODUTOS
            </button>
            <button class="bg-blue-500 bg-opacity-50 text-white px-6 py-2 rounded-md hover:bg-opacity-75 transition">
                MAIS POPULARES
            </button>

            <!-- Search Bar -->
            <div class="search-container relative">
                <input
                    type="text"
                    placeholder="buscar"
                    class="px-4 py-2 rounded-md w-full md:w-48"
                >
                <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
            </div>

            <!-- Dark Mode Toggle -->
            <div class="relative flex items-center ml-4">
                <button id="darkModeToggle" class="text-white hover:text-gray-200 transition-colors">
                    <!-- Sun icon for light mode -->
                    <svg class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <!-- Moon icon for dark mode -->
                    <svg class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <!-- Modified hero-container to use flex -->
        <div class="hero-container flex flex-col md:flex-row items-center md:space-x-8">
            <!-- Text Content -->
            <div class="hero-text-content md:w-1/2 lg:w-3/5 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold mb-6">
                    Somos sua parceira criativa em design gráfico e impressão
                </h1>

                <p class="text-gray-600 dark:text-gray-300 mb-8">
                    Oferecendo desde cartões de visita e folhetos personalizados até banners vibrantes.
                    Com um processo simples, rápido e eficiente, cuidamos de cada detalhe para
                    superar suas expectativas.
                </p>

                <div class="bg-blue-500 text-white px-8 py-3 rounded-full inline-block">
                    Entregamos qualidade e praticidade directo na sua porta!
                </div>

                <div class="mt-6 text-gray-700 dark:text-gray-200">
                    Faça já sua ordem 👉👉👉
                </div>
            </div>

            <!-- Carousel Section -->
            <div class="hero-carousel-wrapper md:w-1/2 lg:w-2/5 mt-8 md:mt-0">
                <div id="heroCarousel" class="relative overflow-hidden rounded-lg shadow-xl mx-auto"
                     style="max-width: 450px;">
                    <div class="carousel-slides flex transition-transform duration-700 ease-in-out">
                        <!-- Images from public/images/carousel/ -->
                        <img src="{{ asset('images/carousel/image 01.png') }}" alt="Carousel Image 1"
                             class="w-full flex-shrink-0 object-cover" style="aspect-ratio: 16/10;">
                        <img src="{{ asset('images/carousel/image 02.png') }}" alt="Carousel Image 2"
                             class="w-full flex-shrink-0 object-cover" style="aspect-ratio: 16/10;">
                        <img src="{{ asset('images/carousel/image 03.png') }}" alt="Carousel Image 3"
                             class="w-full flex-shrink-0 object-cover" style="aspect-ratio: 16/10;">
                    </div>
                    <!-- Navigation Dots -->
                    <div class="carousel-dots absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        <!-- Dots will be generated by JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">NOSSOS PRODUTOS</h2>

        <!-- Initial 6 Products Grid -->
        <div id="productsGrid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- 1. Cartões de Visita -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/business_card.jpg') }}" alt="Cartões de Visita"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">CARTÕES DE VISITA</h3>
                </div>
            </div>

            <!-- 2. Folhetos -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/flyer.jpg') }}" alt="Folhetos"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">FOLHETOS</h3>
                </div>
            </div>

            <!-- 3. Convites -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/invitation.jpg') }}" alt="Convites"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">CONVITES</h3>
                </div>
            </div>

            <!-- 4. Camisetes -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/tshirt.jpg') }}" alt="Camisetes"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">CAMISETES</h3>
                </div>
            </div>

            <!-- 5. Bandeiras -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/flag.jpg') }}" alt="Bandeiras"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">BANDEIRAS</h3>
                </div>
            </div>

            <!-- 6. Indicadores de Mesa -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/table_sign.jpg') }}" alt="Indicadores de Mesa"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">INDICADORES DE MESA</h3>
                </div>
            </div>
        </div>

        <!-- Hidden Products Grid -->
        <div id="extraProducts" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- 7. Roll Ups -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/roll_up.jpg') }}" alt="Roll Ups"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">ROLL UPS</h3>
                </div>
            </div>

            <!-- 8. Banners e Backdrops -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/banner.jpg') }}" alt="Banners e Backdrops"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">BANNERS E BACKDROPS</h3>
                </div>
            </div>

            <!-- 9. Vinil e Countervision -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/vinyl.jpg') }}" alt="Vinil e Countervision"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">VINIL E COUNTERVISION</h3>
                </div>
            </div>

            <!-- 10. Placas PVC -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/pvc_sign.jpg') }}" alt="Placas PVC" class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">FOTOS EM PLACAS PVC</h3>
                </div>
            </div>

            <!-- 11. Bonés Personalizados -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/cap.jpg') }}" alt="Bonés Personalizados" class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">BONÉS PERSONALIZADOS</h3>
                </div>
            </div>

            <!-- 12. Desenho de Layouts -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/layout_design.jpg') }}" alt="Desenho de Layouts"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">DESENHO DE LAYOUTS</h3>
                </div>
            </div>

            <!-- 13. Blocos de Facturação e Recibo -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/invoice_block.jpg') }}" alt="Blocos de Facturação e Recibo"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">BLOCOS DE FACTURAÇÃO E RECIBO</h3>
                </div>
            </div>

            <!-- 14. Blocos de Controle Administrativo -->
            <!-- <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/admin_block.jpg') }}" alt="Blocos de Controle Administrativo"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">BLOCOS DE CONTROLE ADMINISTRATIVO</h3>
                </div>
            </div> -->

            <!-- 15. Crachás Personalizados -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/badge.jpg') }}" alt="Crachás Personalizados"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">CRACHÁS PERSONALIZADOS</h3>
                </div>
            </div>

            <!-- 16. Edição de Documentos -->
            <div class="product-item relative bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/products/document_edit.jpg') }}" alt="Edição de Documentos"
                     class="w-full h-48 object-cover product-image">
                <div class="absolute bottom-4 left-0 w-full bg-gray-900 bg-opacity-50 text-white text-center py-2 product-name-overlay">
                    <h3 class="font-semibold">EDIÇÃO DE DOCUMENTOS</h3>
                </div>
            </div>
        </div>

        <!-- Show More and Checkout Buttons -->
        <div class="text-center mt-8 flex justify-center gap-4">
            <button onclick="toggleProducts()"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-md transition-colors">
                MOSTRAR TUDO
            </button>

            <button
                class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-md transition-colors flex items-center gap-2">
                <i class="fas fa-shopping-cart"></i>
                FAZER ORDEM / CHECKOUT
            </button>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-16">
    <div class="container mx-auto px-4 mt-12">
        <!-- Change bg-gray-800/40 to bg-gray-100 (light grey-white) and remove backdrop-blur-sm -->
        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-8 max-w-3xl mx-auto">
            <div class="text-center">
                <p class="mb-4 text-gray-700 dark:text-gray-200">
                    <!-- Update text color for better contrast -->
                    Somos uma empresa jovem e dinâmica, impulsionada pela energia e criatividade da nova geração. Com
                    uma equipe cheia de entusiasmo e eficiência, transformamos ideias em soluções inovadoras, sempre
                    com um toque de modernidade e agilidade.
                </p>
                <p class="text-gray-700 dark:text-gray-200">
                    <!-- Update text color for better contrast -->
                    Na <span class="font-bold text-gray-900 dark:text-white">Tri-Color Design</span> a juventude é
                    nossa força, e a inovação, nosso compromisso!
                </p>

                <!-- WhatsApp Button -->
                <a href="#"
                   class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-md transition-colors mt-6">
                    <i class="fab fa-whatsapp text-xl"></i>
                    LAYOUT DESIGN - WHATSAPP
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-100 dark:bg-gray-800 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo Column -->
            <div>
                <img
                    src="{{ asset('images/logo_black.png') }}"
                    alt="Tri Color Design"
                    class="w-48 mb-4 dark:hidden"
                >
                <img
                    src="{{ asset('images/logo_white_footer.png') }}"
                    alt="Tri Color Design"
                    class="w-48 mb-4 hidden dark:block"
                >
            </div>

            <!-- About Column -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Sobre a Tri Color</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Termos
                            e Condições</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Subscreva
                            ao nosso canal do whatsapp</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Condições
                            de entrega</a></li>
                </ul>
            </div>

            <!-- Resources Column -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Recursos</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Serviços
                            de Design</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Regras
                            de Submissão de Design</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Templates</a></li>
                </ul>
            </div>

            <!-- Products Column -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Produtos da Tri Color</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Produtos
                            da Tri Color</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Mais
                            solicitados</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Banners
                            e Roll ups</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Dark Mode Toggle Script -->
<script>
    const darkModeToggle = document.getElementById('darkModeToggle');

    darkModeToggle.addEventListener('click', () => {
        // Toggle dark mode
        document.documentElement.classList.toggle('dark');

        // Save preference
        if (document.documentElement.classList.contains('dark')) {
            localStorage.theme = 'dark';
        } else {
            localStorage.theme = 'light';
        }
    });
</script>

<!-- Products Toggle Script -->
<script>
    function toggleProducts() {
        const extraProducts = document.getElementById('extraProducts');
        const button = event.currentTarget;

        if (extraProducts.classList.contains('hidden')) {
            extraProducts.classList.remove('hidden');
            button.textContent = 'MOSTRAR MENOS';
        } else {
            extraProducts.classList.add('hidden');
            button.textContent = 'MOSTRAR TUDO';
        }
    }
</script>

<!-- Hero Carousel Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('heroCarousel');
        if (!carousel) return; // Exit if carousel element not found

        const slidesContainer = carousel.querySelector('.carousel-slides');
        const slides = Array.from(slidesContainer.children);
        const dotsContainer = carousel.querySelector('.carousel-dots');
        const totalSlides = slides.length;
        let currentIndex = 0;
        let slideInterval;

        if (totalSlides === 0) return; // Exit if no slides

        // Create dots
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('span');
            dot.classList.add('carousel-dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                goToSlide(i);
                resetInterval();
            });
            dotsContainer.appendChild(dot);
        }
        const dots = Array.from(dotsContainer.children);

        function updateDots() {
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }

        function goToSlide(index) {
            if (index < 0 || index >= totalSlides) return;
            slidesContainer.style.transform = `translateX(-${index * 100}%)`;
            currentIndex = index;
            updateDots();
        }

        function nextSlide() {
            let nextIndex = (currentIndex + 1) % totalSlides;
            goToSlide(nextIndex);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
        }

        // Initial setup
        goToSlide(0); // Ensure first slide is shown correctly
        resetInterval(); // Start auto-play

        // Optional: Pause on hover
        carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
        carousel.addEventListener('mouseleave', () => resetInterval());
    });
</script>

<script>
    function shuffleProducts() {
        const grid = document.getElementById('productsGrid');
        const extraGrid = document.getElementById('extraProducts'); // Get the extra grid
        let products = Array.from(grid.children);
        let extraProducts = Array.from(extraGrid.children); // Get the extra products

        const areAllProductsVisible = !extraGrid.classList.contains('hidden');

        products = products.concat(extraProducts); // Merge both product lists into one

        // Fade-out product list
        products.forEach((product, i) => {
            product.classList.add('fade-out');

            // Reset to default styles
        });

        // 3. Wait for fade-out animation to complete before reshuffling
        setTimeout(() => {
            // 2. Shuffle
            // Fisher-Yates Shuffle Algorithm
            for (let i = products.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [products[i], products[j]] = [products[j], products[i]];
            }


            // Clear existing grids
            grid.innerHTML = '';
            extraGrid.innerHTML = '';

            const visibleProductCount = areAllProductsVisible ? products.length : 6;

            // Insert Back Product list
            for (let i = 0; i < products.length; i++) {
                products[i].classList.add('fade-in');
                void products[i].offsetWidth;
                if (i < visibleProductCount) {
                    grid.appendChild(products[i]);
                } else {
                    extraGrid.appendChild(products[i]);
                }
            }
            if (products.length  < 6 || !areAllProductsVisible) extraGrid.classList.add("hidden")
            //Staggered FadeIn
            products.slice(0, visibleProductCount).forEach((product, index) => {
                    setTimeout(() => {
                         product.classList.add("fade-in");
                    void product.offsetWidth;
                        product.classList.add("fade-out");

                     setTimeout(() => product.classList.remove('fade-out'), 500)

                    }, index * 100); // Staggered delay (0.1s per item)
               });


        }, 500); // Wait for fade-out duration (0.5s)
    }

    document.addEventListener('DOMContentLoaded', () => {
        shuffleProducts(); // Initial shuffle
        setInterval(shuffleProducts, 10000); // Shuffle every 10 seconds
    });
</script>
</body>
</html>