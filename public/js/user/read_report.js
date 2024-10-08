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

function shareClicked(){
    document.querySelector(".modal-container").style.display = "block";
}

function closeShare(){
    document.querySelector(".modal-container").style.display = "none";
}

function copyLink() {
    var linkInput = document.getElementById("link");

    linkInput.select();
    linkInput.setSelectionRange(0, 99999); 

    document.execCommand("copy");

    showAlert("Link copied to clipboard!", "success");
}

function showAlert(message, type) {
    var alertContainer = document.getElementById("alert-container");
    var alertElement = document.createElement("div");

    alertElement.className = `alert alert-${type} alert-dismissible fade show`;
    alertElement.role = "alert";
    alertElement.style.whiteSpace = "nowrap"; 
    alertElement.innerHTML = `${message} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`;
    
    alertContainer.appendChild(alertElement);

    setTimeout(() => {
        alertElement.style.width = alertElement.offsetWidth + "px";
        alertElement.style.whiteSpace = "normal"; 
    }, 0);

    setTimeout(function () {
        var alert = new bootstrap.Alert(alertElement);
        alert.close();
    }, 3000);
}


function DeleteOutOfShelve(bookName){
    Swal.fire({
        title: `คุณต้องการที่จะลบเรื่อง "${bookName}" ออกจากชั้นหนังสือหรือไม่?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `ยืนยัน`,
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-shelve-form").submit();
        }
    });
}