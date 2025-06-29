document.addEventListener('DOMContentLoaded', function() {
    const showMoreBtn = document.getElementById('showMoreBtn');
    const hiddenProducts = document.querySelector('.hidden-products');
    
    showMoreBtn.addEventListener('click', function() {
        if (hiddenProducts.classList.contains('hidden')) {
            hiddenProducts.classList.remove('hidden');
            showMoreBtn.textContent = 'MOSTRAR MENOS';
            
            // Animate new products in
            const newProducts = hiddenProducts.querySelectorAll('.product-card');
            newProducts.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        } else {
            // Animate products out
            const newProducts = hiddenProducts.querySelectorAll('.product-card');
            newProducts.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                }, index * 50);
            });

            setTimeout(() => {
                hiddenProducts.classList.add('hidden');
                showMoreBtn.textContent = 'MOSTRAR TUDO';
            }, newProducts.length * 50 + 300);
        }
    });
}); 