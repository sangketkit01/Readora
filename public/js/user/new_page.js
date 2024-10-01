document.addEventListener('DOMContentLoaded', function () { // ทำงานตั้งแต่เริ่มโหลดหน้า
    const itemsPerPage = 8; //กำหนกว่าในแต่ละหน้ามีได้8item
    const bookList = document.getElementById('bookList');//อ้างอิงถึง element ที่เก็บรายการหนังสือ
    const pagination = document.getElementById('pagination'); //อ้างอิงถึง element สำหรับเปลี่ยนหน้า
    const items = bookList.getElementsByClassName('list-group-item'); //อ้างอิงถึงitemืั้งหมดใน element นี้

    let pageCount = Math.ceil(items.length / itemsPerPage); //คำนวณจำนวนหน้า
    let nowFilter = 'all'; //เริ่มต้นหน้าด้วยfilter all

    const tabs = document.querySelectorAll('.tab');//ดึง tab ทั้งหมดมา

    let currentPage = 1; //หน้าปัจจุบันเริ่มที่ 1

    function getVisibleItems() {
        return Array.from(items).filter(item => item.style.display !== 'none');
    }

    function showPage(page) { // 
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const displayItems = filterItems(nowFilter);

        for (let i = 0; i < displayItems.length; i++) {
            displayItems[i].style.display = (
                i >= startIndex && i < endIndex ? 'flex' : 'none'
            );
        }
    }

    function setupPagination() {
        pagination.innerHTML = '';

        // Previous button
        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '&larr;'; // Left arrow
        prevBtn.addEventListener('click', function () {
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
        nextBtn.addEventListener('click', function () {
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

    function filterItems(filter) {
        return Array.from(items).filter(book => {
            if (filter === 'all') {
                return true
            } else if (filter === 'author') {
                const authorName = book.querySelector('p:nth-child(2)').textContent.replace("ผู้เขียน:", "").trim().toLowerCase(); 
                const query = document.getElementById('mainContainer').getAttribute('data-query');
                if (authorName.includes(query.toLowerCase())) {
                    return true
                } else {
                    return false
                }
            } else if (filter === 'novel') {
                const type = book.querySelector('p:nth-child(3)').textContent.replace("ประเภท:", "").trim().toLowerCase();
                console.log(type)
                if (type == 'novel') {
                    return true
                } else {
                    return false
                }
            } else if (filter === 'comic') {
                const type = book.querySelector('p:nth-child(3)').textContent.replace("ประเภท:", "").trim().toLowerCase();
                if (type == 'comic') {
                    return true
                } else {
                    return false
                }
            }
        });
    }

    tabs.forEach(tab => { 
        tab.addEventListener('click', function () { //loop tab ออกมาทีละตัวรอการคลิก
            currentPage = 1; // Reset to page 1 when filter changes
            currentFilter = this.getAttribute('id');

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            if (currentFilter === 'all') {
                nowFilter = 'all';
            } else if (currentFilter === 'author') {
                nowFilter = 'author';
            } else if (currentFilter === 'novel') {
                nowFilter = 'novel';
            } else if (currentFilter === 'comic') {
                nowFilter = 'comic';
            }
            // Update page numbers after filtering
            getVisibleItems().filter(item => item.style.display !== 'none')

            const displayItems = filterItems(nowFilter);
            pageCount = Math.ceil(displayItems.length / itemsPerPage);
            if (pageCount == 0) {
                pageCount = 1
            }
            showPage(currentPage);
            updatePaginationState();
        });
    });

    showPage(currentPage);
    setupPagination();
    updatePaginationState();
});