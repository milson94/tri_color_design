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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <!-- Moon icon for dark mode -->
                            <svg class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-container">
                    <div class="hero-text-content">
                        <h1 class="text-3xl md:text-4xl font-bold mb-6">
                            Somos sua parceira criativa em design gráfico e impressão
                        </h1>
                        
                        <p class="text-gray-600 mb-8">
                            Oferecendo desde cartões de visita e folhetos personalizados até banners vibrantes. 
                            Com um processo simples, rápido e eficiente, cuidamos de cada detalhe para 
                            superar suas expectativas.
                        </p>
                        
                        <div class="bg-blue-500 text-white px-8 py-3 rounded-full inline-block">
                            Entregamos qualidade e praticidade directo na sua porta!
                        </div>
                        
                        <div class="mt-6">
                            Faça já sua ordem 👉👉👉
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- 1. Cartões de Visita -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">CARTÕES DE VISITA</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Folhetos -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">FOLHETOS</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Convites -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">CONVITES</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Camisetes -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">CAMISETES</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Bandeiras -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">BANDEIRAS</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Indicadores de Mesa -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">INDICADORES DE MESA</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden Products Grid -->
                <div id="extraProducts" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <!-- 7. Roll Ups -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">ROLL UPS</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Banners e Backdrops -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">BANNERS E BACKDROPS</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 9. Vinil e Countervision -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">VINIL E COUNTERVISION</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 10. Placas PVC -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">PLACAS PVC</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 11. Bonés Personalizados -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">BONÉS PERSONALIZADOS</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 12. Desenho de Layouts -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">DESENHO DE LAYOUTS</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 13. Blocos de Facturação e Recibo -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">BLOCOS DE FACTURAÇÃO E RECIBO</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 14. Blocos de Controle Administrativo -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">BLOCOS DE CONTROLE ADMINISTRATIVO</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 15. Crachás Personalizados -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">CRACHÁS PERSONALIZADOS</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 16. Edição de Documentos -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="bg-blue-500 text-white py-2 px-4 text-center mb-4">EDIÇÃO DE DOCUMENTOS</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-900 dark:text-blue-300 font-semibold">10.00Mt Cada</span>
                                <div class="flex items-center border dark:border-gray-600 rounded">
                                    <button class="px-2 py-1 text-blue-500">-</button>
                                    <span class="px-4 border-x">01</span>
                                    <button class="px-2 py-1 text-blue-500">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Show More and Checkout Buttons -->
                <div class="text-center mt-8 flex justify-center gap-4">
                    <button onclick="toggleProducts()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-md transition-colors">
                        MOSTRAR TUDO
                    </button>
                    
                    <button class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-md transition-colors flex items-center gap-2">
                        <i class="fas fa-shopping-cart"></i>
                        FAZER ORDEM / CHECKOUT
                    </button>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="py-16">
            <div class="container mx-auto px-4 mt-12">
                <div class="bg-gray-800/40 rounded-lg p-8 backdrop-blur-sm max-w-3xl mx-auto">
                    <div class="text-center">
                        <p class="mb-4 dark:text-white">
                            Somos uma empresa jovem e dinâmica, impulsionada pela energia e criatividade da nova geração. Com uma equipe cheia de entusiasmo e eficiência, transformamos ideias em soluções inovadoras, sempre com um toque de modernidade e agilidade.
                        </p>
                        <p class="dark:text-white">
                            Na <span class="italic">Tri-Color Design</span> a juventude é nossa força, e a inovação, nosso compromisso!
                        </p>

                        <!-- WhatsApp Button -->
                        <a href="#" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-md transition-colors mt-6">
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
                        <h3 class="text-lg font-semibold mb-4">Sobre a Tri Color</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Termos e Condições</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Subscreva ao nosso canal do whatsapp</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Condições de entrega</a></li>
                        </ul>
                    </div>

                    <!-- Resources Column -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Recursos</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Serviços de Design</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Regras de Submissão de Design</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Templates</a></li>
                        </ul>
                    </div>

                    <!-- Products Column -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Produtos da Tri Color</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Produtos da Tri Color</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Mais solicitados</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Banners e Roll ups</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Add this before your closing body tag -->
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
    </body>
</html>
