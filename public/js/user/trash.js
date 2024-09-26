

function RestoreAll(){
    console.log(document.getElementById("restore-all"));
     Swal.fire({
         title: `คุณต้องการจะกู้คืนตอนทั้งหมดใช่หรือไม่?`,
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

function RestoreEach(chapterID,chapterName){
    Swal.fire({
        title: `คุณต้องการที่จะกู้คืนตอน "${chapterName}" หรือไม่`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `ยืนยัน`,
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "กำลังกู้คืนตอน...",
                text: "กรุณารอสักครู่",
                icon: "info",
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });
            document.getElementById(`restore-each-${chapterID}`).submit();
        }
    });
}