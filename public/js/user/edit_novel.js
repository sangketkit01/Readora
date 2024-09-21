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

