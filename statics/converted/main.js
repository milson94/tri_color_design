document.addEventListener('DOMContentLoaded', function() {
    // --- Dark Mode Toggle Functionality (from darkMode.txt) ---
    const darkModeToggle = document.getElementById('darkModeToggle');

    // Note: The initial dark mode preference check is already inlined in index.html for faster application.
    // This part handles the click event for toggling.
    darkModeToggle.addEventListener('click', function() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
            console.log('Switched to light mode');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
            console.log('Switched to dark mode');
        }
    });

    // --- Hero Carousel Script (from index.txt) ---
    const carousel = document.getElementById('heroCarousel');
    if (carousel) { // Ensure carousel element exists
        const slidesContainer = carousel.querySelector('.carousel-slides');
        const slides = Array.from(slidesContainer.children);
        const dotsContainer = carousel.querySelector('.carousel-dots');
        const totalSlides = slides.length;
        let currentIndex = 0;
        let slideInterval;

        if (totalSlides > 0) { // Only proceed if there are slides
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
        }
    }


    // --- Products Toggle Script (from index.txt) ---
    // Make it a global function as it's called via onclick in HTML
    window.toggleProducts = function() {
        const extraProducts = document.getElementById('extraProducts');
        const button = event.currentTarget; // Using event.currentTarget to get the clicked button

        if (extraProducts.classList.contains('hidden')) {
            extraProducts.classList.remove('hidden');
            button.textContent = 'MOSTRAR MENOS';
        } else {
            extraProducts.classList.add('hidden');
            button.textContent = 'MOSTRAR TUDO';
        }
    };


    // --- Products Shuffle Script (from index.txt) ---
    function shuffleProducts() {
        const grid = document.getElementById('productsGrid');
        const extraGrid = document.getElementById('extraProducts');
        let products = Array.from(grid.children);
        let extraProducts = Array.from(extraGrid.children);

        const areAllProductsVisible = !extraGrid.classList.contains('hidden');

        products = products.concat(extraProducts);

        // Fade-out product list
        products.forEach((product) => {
            product.classList.add('fade-out');
            product.classList.remove('fade-in'); // Ensure fade-in is removed for proper fade-out
        });

        // Wait for fade-out animation to complete before reshuffling
        setTimeout(() => {
            // Shuffle (Fisher-Yates)
            for (let i = products.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [products[i], products[j]] = [products[j], products[i]];
            }

            // Clear existing grids
            grid.innerHTML = '';
            extraGrid.innerHTML = '';

            const visibleProductCount = areAllProductsVisible ? products.length : 6;

            // Insert Back Product list and prepare for fade-in
            products.forEach((product, i) => {
                // Remove fade-out immediately before re-appending
                product.classList.remove('fade-out');
                if (i < visibleProductCount) {
                    grid.appendChild(product);
                } else {
                    extraGrid.appendChild(product);
                }
            });

            if (products.length < 6 || !areAllProductsVisible) {
                extraGrid.classList.add("hidden");
            } else {
                extraGrid.classList.remove("hidden"); // Ensure it's visible if it should be
            }


            // Staggered FadeIn for currently visible products
            const productsToFadeIn = areAllProductsVisible ? products : products.slice(0, 6);

            productsToFadeIn.forEach((product, index) => {
                // Trigger reflow to ensure transition
                void product.offsetWidth;
                setTimeout(() => {
                    product.classList.add("fade-in");
                }, index * 100); // Staggered delay (0.1s per item)
            });

        }, 500); // Wait for fade-out duration (0.5s)
    }

    // Initial shuffle and interval setup
    shuffleProducts();
    setInterval(shuffleProducts, 10000); // Shuffle every 10 seconds
});