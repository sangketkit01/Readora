document.addEventListener('DOMContentLoaded', function () {
    const itemsPerPage = 8;  // จำนวนรายการต่อหน้า
    const bookList = document.getElementById('bookList');  // รายการหนังสือ
    const pagination = document.getElementById('pagination');  // ตัวแบ่งหน้า
    const items = bookList.getElementsByClassName('list-group-item');  // ดึงรายการแต่ละรายการมา

    let pageCount = Math.ceil(items.length / itemsPerPage);  // จำนวนหน้าทั้งหมด
    let nowFilter = 'all';  // ตัวกรองปัจจุบันเริ่มที่ 'ทั้งหมด'

    const tabs = document.querySelectorAll('.tab');  // ดึงแท็บทั้งหมด
    let currentPage = 1;  // หน้าปัจจุบัน

    // ฟังก์ชันสำหรับกรองการรายงานตามประเภทหนังสือ
    function filterItems(filter) {
        return Array.from(items).filter(book => {
            const bookTypeID = parseInt(book.getAttribute('data-book-type-id'), 10);  // ดึง bookTypeID จาก data attribute

            if (filter === 'all') {
                return true;  // แสดงการรายงานทั้งหมด
            } else if (filter === 'novel') {
                return bookTypeID === 1;  // กรองเฉพาะนิยาย (bookTypeID = 1)
            } else if (filter === 'comic') {
                return bookTypeID === 2;  // กรองเฉพาะคอมมิค (bookTypeID = 2)
            }
        });
    }

    // ฟังก์ชันสำหรับแสดงผลหน้าปัจจุบัน
    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const displayItems = filterItems(nowFilter);

        // ซ่อนทุกรายการก่อนแล้วค่อยแสดงผลตามเงื่อนไข
        for (let i = 0; i < displayItems.length; i++) {
            displayItems[i].style.display = (i >= startIndex && i < endIndex) ? 'flex' : 'none';
        }
    }

    // ฟังก์ชันสำหรับสร้าง Pagination
    function setupPagination() {
        pagination.innerHTML = '';  // ล้าง Pagination เก่าก่อน

        // ปุ่ม Previous
        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '&larr;';  // ลูกศรซ้าย
        prevBtn.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                updatePaginationState();
                window.scrollTo(0, 0);  // เลื่อนหน้าไปด้านบนสุด
            }
        });
        pagination.appendChild(prevBtn);

        // ตัวบ่งชี้หน้าปัจจุบัน
        const pageIndicator = document.createElement('span');
        pageIndicator.id = 'pageIndicator';
        pageIndicator.textContent = `${currentPage} / ${pageCount}`;  // แสดงหน้าปัจจุบันและจำนวนหน้าทั้งหมด
        pagination.appendChild(pageIndicator);

        // ปุ่ม Next
        const nextBtn = document.createElement('button');
        nextBtn.innerHTML = '&rarr;';  // ลูกศรขวา
        nextBtn.addEventListener('click', function () {
            if (currentPage < pageCount) {
                currentPage++;
                showPage(currentPage);
                updatePaginationState();
                window.scrollTo(0, 0);  // เลื่อนหน้าไปด้านบนสุด
            }
        });
        pagination.appendChild(nextBtn);
    }

    // ฟังก์ชันสำหรับอัปเดตสถานะ Pagination
    function updatePaginationState() {
        const pageIndicator = document.getElementById('pageIndicator');
        pageIndicator.textContent = `${currentPage} / ${pageCount}`;  // อัปเดตตัวบ่งชี้หน้า

        const [prevBtn, nextBtn] = pagination.getElementsByTagName('button');
        prevBtn.disabled = currentPage === 1;  // ปิดการใช้งานปุ่ม Previous เมื่ออยู่ที่หน้าแรก
        nextBtn.disabled = currentPage === pageCount;  // ปิดการใช้งานปุ่ม Next เมื่ออยู่ที่หน้าสุดท้าย
    }

    // เพิ่ม event listener ให้แท็บต่างๆ
    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            currentPage = 1;  // รีเซ็ตไปที่หน้าที่ 1 เมื่อมีการเปลี่ยนแท็บ
            currentFilter = this.getAttribute('id');  // ดึง id ของแท็บที่เลือก

            tabs.forEach(t => t.classList.remove('active'));  // ลบ class 'active' ออกจากทุกแท็บ
            this.classList.add('active');  // เพิ่ม class 'active' ให้กับแท็บที่ถูกเลือก

            nowFilter = currentFilter === 'all' ? 'all' : currentFilter;  // อัปเดตตัวกรอง
            getVisibleItems().forEach(item => item.style.display = 'none');  // ซ่อนทุก item ก่อน

            const displayItems = filterItems(nowFilter);  // กรอง item ตามแท็บที่เลือก
            pageCount = Math.ceil(displayItems.length / itemsPerPage);  // คำนวณจำนวนหน้าใหม่ตามการกรอง
            if (pageCount === 0) {
                pageCount = 1;  // ถ้าไม่มีข้อมูล ให้ตั้งค่า pageCount เป็น 1
            }
            showPage(currentPage);  // แสดงหน้าปัจจุบัน
            updatePaginationState();  // อัปเดตสถานะของ Pagination
        });
    });

    showPage(currentPage);  // แสดงหน้าปัจจุบันครั้งแรก
    setupPagination();  // สร้าง Pagination ครั้งแรก
    updatePaginationState();  // อัปเดตสถานะของ Pagination
});
