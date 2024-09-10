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

            inputImage.style.display = "inline-block";
        }
    });
});

function submitForm() {
    let recommend = document.getElementById("hiddenTextareaRecommend");
    let title = document.getElementById("hiddenTextareaTitle");

    let recommendInput = document.getElementById("recommend-input").innerHTML;
    let titleInput = document.getElementById("add-title-input").innerHTML;

    if (titleInput === "เพิ่มชื่อเรื่อง" || titleInput === "") {
        alert("กรุณาเพิ่มชื่อเรื่อง");
        return;
    }

    if (recommendInput === "") {
        recommendInput = "ไม่มีคำแนะนำเนื้อเรื่อง";
    }

    recommend.value = recommendInput;
    title.value = titleInput;

    let form = document.getElementById("form");
    if (form.checkValidity()) {
        form.submit();
    } else {
        alert("กรุณาใส่รูปภาพ");
    }
}
