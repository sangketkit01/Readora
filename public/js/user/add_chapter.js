let imageInput = document.getElementById("image-input");
let imageLabel = document.getElementById("image-input-label");


const maxFileSize = 10 * 1024 * 1024;

imageInput.addEventListener("change",(event)=>{
    const file = event.target.files[0];

    if(file && file.type.startsWith("image/")){
        if(file.size > maxFileSize){
            alert("ขนาดไฟล์ต้องไม่เกิน 10 MB");
            return;
        }

        const imageUrl = URL.createObjectURL(file)
        imageLabel.style.backgroundImage = `url(${imageUrl})`;
        imageLabel.style.backgroundSize = "contain";
    }
})


function submitForm() {
    let title = document.getElementById("title-name");
    let content = document.getElementById("content");
    let writerMessage = document.getElementById("writer_message");
    let form = document.getElementById("form");
    let imageInput = document.getElementById("image-input"); 


    if (title.value.trim() === "" || content.value.trim() === "") {
        alert("กรุณากรอกข้อมูลให้ครบ");
        return;
    }
    if (writerMessage.value.trim() === "") {
        document.getElementById("writer_message").value = "No Writer message";
    }

    if (imageInput.files.length === 0) {
        alert("กรุณาเลือกรูปภาพ");
        return;
    }

    if (form.checkValidity()) {
        form.submit();
    } else {
        alert("ข้อมูลไม่ถูกต้อง");
        return;
    }
}
