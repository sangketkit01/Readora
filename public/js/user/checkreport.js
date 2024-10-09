
document.addEventListener('DOMContentLoaded', function () {
    initializeReportSystem();
});

function initializeReportSystem() {
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const type = tab.getAttribute('id');
            filterReports(type);
        });
    });


    const reportCards = document.querySelectorAll('.result-card-link');
    reportCards.forEach(card => {
        card.addEventListener('click', function (event) {
            event.preventDefault();
            const reportID = this.dataset.reportid;
            const detailUrl = this.href;
            markReportAsRead(reportID, detailUrl);
        });
    });
}

function filterReports(type) {
    const reports = document.querySelectorAll('.result-card');
    
    reports.forEach(report => {
        const reportTypeId = report.getAttribute('data-type');
        if (type === 'all' || reportTypeId === type) {
            report.parentElement.style.display = ''; 
        } else {
            report.parentElement.style.display = 'none'; 
        }
    });

    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.getElementById(type).classList.add('active');
}

function markReportAsRead(reportID, detailUrl) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/admin/report/read/${reportID}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            
            window.location.href = detailUrl;
        }
        
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
