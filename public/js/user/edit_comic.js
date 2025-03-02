document.addEventListener("DOMContentLoaded", function () {
    let inputImageLabel = document.getElementById("input-image-label");
    let inputImage = document.getElementById("inputImage");

    const maxFileSize = 10 * 1024 * 1024;
    inputImage.addEventListener("change", (event) => {
        const file = event.target.files[0];

        if (file && file.type.startsWith("image/")) {
            if (file.size > maxFileSize) {
                alert("ขนาดไฟล์ต้องไม่เกิน 10 MB");
                return;
            }

            const imageUrl = URL.createObjectURL(file);
            inputImageLabel.style.backgroundImage = `url(${imageUrl})`;
            inputImageLabel.style.backgroundSize = "contain";
        }
    });

    document.querySelectorAll(".pub-chapter").forEach((pub) => {
        pub.addEventListener("change", function () {
            const form = this.closest(".chapter-form");
            if (form) {
                form.submit();
            }
        });
    });
});

function DeleteComic(bookName) {
    Swal.fire({
        title: `คุณต้องการที่จะลบคอมมิกเรื่อง "${bookName}" หรือไม่?`,
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

function DeleteChapter(chapterName, chapterID) {
    Swal.fire({
        title: `คุณต้องการที่จะลบตอน "${chapterName}" หรือไม่?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `ยืนยัน`,
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "กำลังลบตอน...",
                text: "กรุณารอสักครู่",
                icon: "info",
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });

            document
                .getElementById(`delete-chapter-form-${chapterID}`)
                .submit();
        }
    });
}


function submitForm() {
    const form = document.getElementById("form");

    if (form.checkValidity()) {
        form.submit();
    } else {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "กรุณากรอกข้อมูลให้ครบถ้วน",
        });
    }
}

