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

