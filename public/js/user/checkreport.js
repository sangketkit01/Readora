function filterReports(type) {
    console.log('Selected type:', type); // ตรวจสอบค่า type
    // เลือกการ์ดรีพอร์ตทั้งหมด
    const reports = document.querySelectorAll('.result-card');

    // ลูปผ่านการ์ดรีพอร์ตแต่ละใบ
    reports.forEach(report => {
        const reportTypeId = report.getAttribute('data-type'); // ดึง bookType จาก data-type
        console.log('Report Type ID:', reportTypeId); // ตรวจสอบค่า reportTypeId

        // แสดงหรือซ่อนการ์ดตามประเภทที่เลือก
        if (type === 'all' || reportTypeId === type) {
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
    document.getElementById(type).classList.add('active');
}
