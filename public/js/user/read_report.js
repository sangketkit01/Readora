function openModal() {
    document.getElementById('reportModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('reportModal').style.display = 'none';
}

window.onclick = function(event) {
    var modal = document.getElementById('reportModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
