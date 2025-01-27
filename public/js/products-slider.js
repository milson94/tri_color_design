document.addEventListener('DOMContentLoaded', function() {
    const pages = document.querySelectorAll('.products-page');
    const prevButton = document.getElementById('prevPage');
    const nextButton = document.getElementById('nextPage');
    const pageIndicator = document.getElementById('pageIndicator');
    let currentPage = 1;
    const totalPages = pages.length;

    function showPage(pageNumber) {
        pages.forEach(page => page.classList.add('hidden'));
        pages[pageNumber - 1].classList.remove('hidden');
        pageIndicator.textContent = `página ${pageNumber} de ${totalPages}`;
        
        // Update button states
        prevButton.style.opacity = pageNumber === 1 ? '0.5' : '1';
        nextButton.style.opacity = pageNumber === totalPages ? '0.5' : '1';
    }

    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Initialize first page
    showPage(1);
}); 