function DeleteComic(bookName) {
    Swal.fire({
        title: `คุณต้องการที่จะปลดบล็อคเรื่อง "${bookName}" หรือไม่?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `ยืนยัน`,
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form").submit();
        }
    });
}

$('#confirmModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var bookId = button.data('bookid'); // Extract bookID from data-* attributes

    // Update the modal's content
    var modal = $(this);
    modal.find('#bookName').text(button.data('bookname'));
    // Set the action for the form using the correct route
    modal.find('#unblockForm').attr('action', 'book.unblock' + bookId); // Use your route here
});