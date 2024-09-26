document.addEventListener("DOMContentLoaded", function () {
    let inputImageLabel = document.getElementById("input-image-label");
    let inputImage = document.getElementById("inputImage");

    const maxFileSize = 10 * 1024 * 1024;
    inputImage.addEventListener("change", (event) => {
        const file = event.target.files[0];

        if (file && file.type.startsWith("image/")) {
            if (file.size > maxFileSize) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "ขนาดไฟล์ต้องไม่เกิน 10 MB",
                });
                return;
            }

            const imageUrl = URL.createObjectURL(file);
            inputImageLabel.style.backgroundImage = `url(${imageUrl})`;
            inputImageLabel.style.backgroundSize = "contain";
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "กรุณาเพิ่มรูปภาพ",
            });
        }
    });
});


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
