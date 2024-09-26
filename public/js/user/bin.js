function RestoreAll(bookTypeID) {
    let bookTypeName = bookTypeID == 1 ? "นิยาย" : "คอมมิค";
    Swal.fire({
        title: `คุณต้องการจะกู้คืน${bookTypeName}ทั้งหมดหรือไม่?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `ยืนยัน`,
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("restore-all").submit();
        }
    });
}

function RestoreEach(bookID, bookTypeID,bookName) {
    let bookTypeName = bookTypeID == 1 ? "นิยาย" : "คอมมิค";
    Swal.fire({
        title: `คุณต้องการที่จะกู้${bookTypeName} "${bookName}" หรือไม่`,
        icon: "warning",
        text: "ตอนทั้งหมดจะอยู่ในถังขยะ",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `ยืนยัน`,
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "กำลังกู้นิยาย...",
                text: "กรุณารอสักครู่",
                icon: "info",
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });
            document.getElementById(`restore-each-${bookID}`).submit();
        }
    });
}