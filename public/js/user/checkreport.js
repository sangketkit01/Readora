// report-management.js
document.addEventListener('DOMContentLoaded', function () {
    initializeReportSystem();
});

function initializeReportSystem() {
    // Initialize report filtering
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const type = tab.getAttribute('id');
            filterReports(type);
        });
    });

    // Initialize report card click handlers
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
            report.parentElement.style.display = ''; // Show the card's container
        } else {
            report.parentElement.style.display = 'none'; // Hide the card's container
        }
    });

    // Update active tab
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.getElementById(type).classList.add('active');
}

function markReportAsRead(reportID, detailUrl) {
    // Get CSRF token from meta tag
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
            // Redirect to book detail page without showing any message
            window.location.href = detailUrl;
        }
        // No alert or message shown in case of failure
    })
    .catch(error => {
        console.error('Error:', error);
        // No alert or message shown in case of error
    });
}
