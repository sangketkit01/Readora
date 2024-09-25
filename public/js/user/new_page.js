document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 8;
    const bookList = document.getElementById('bookList');
    const pagination = document.getElementById('pagination');
    const items = bookList.getElementsByClassName('list-group-item');
    const pageCount = Math.ceil(items.length / itemsPerPage);
    let currentPage = 1;

    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        for (let i = 0; i < items.length; i++) {
            items[i].style.display = i >= startIndex && i < endIndex ? 'flex' : 'none';
        }
    }

    function setupPagination() {
        pagination.innerHTML = '';

        // Previous button
        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '&larr;'; // Left arrow
        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                updatePaginationState();
                window.scrollTo(0, 0);
            }
        });
        pagination.appendChild(prevBtn);

        // Current page indicator
        const pageIndicator = document.createElement('span');
        pageIndicator.id = 'pageIndicator';
        pageIndicator.textContent = `${currentPage} / ${pageCount}`;
        pagination.appendChild(pageIndicator);

        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.innerHTML = '&rarr;'; // Right arrow
        nextBtn.addEventListener('click', function() {
            if (currentPage < pageCount) {
                currentPage++;
                showPage(currentPage);
                updatePaginationState();
                window.scrollTo(0, 0);
            }
        });
        pagination.appendChild(nextBtn);
    }

    function updatePaginationState() {
        const pageIndicator = document.getElementById('pageIndicator');
        pageIndicator.textContent = `${currentPage} / ${pageCount}`;

        const [prevBtn, nextBtn] = pagination.getElementsByTagName('button');
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === pageCount;
    }

    showPage(currentPage);
    setupPagination();
    updatePaginationState();
});