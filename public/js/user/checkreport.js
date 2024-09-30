function filterReports(type) {
    // เลือกการ์ดรีพอร์ตทั้งหมด
    const reports = document.querySelectorAll('.result-card');

    // ลูปผ่านการ์ดรีพอร์ตแต่ละใบ
    reports.forEach(report => {
        const reportTypeId = report.getAttribute('data-type'); // ดึง bookTypeId จาก data-type

        // แสดงหรือซ่อนการ์ดตามประเภทที่เลือก
        if (type === 'all' || reportTypeId == type) {
            report.style.display = 'flex'; // แสดงการ์ด
        } else {
            report.style.display = 'none'; // ซ่อนการ์ด
        }
    });

    // เปลี่ยนสถานะของแท็บที่ถูกเลือก
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.classList.remove('active'); // ลบคลาส active ออกจากแท็บทั้งหมด
    });

    // เพิ่มคลาส active ให้กับแท็บที่ถูกเลือก
    if (type === '1') {
        document.getElementById('novel').classList.add('active');
    } else if (type === '2') {
        document.getElementById('comic').classList.add('active');
    } else {
        document.getElementById('all').classList.add('active');
    }
}
