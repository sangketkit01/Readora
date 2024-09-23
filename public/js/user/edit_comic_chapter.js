function loadPdfFromUrl(url) {
    const output = document.getElementById("output");
    output.innerHTML = "";

    pdfjsLib.getDocument(url).promise.then(function (pdf) {
        for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
            pdf.getPage(pageNumber).then(function (page) {
                const scale = 0.8;
                const viewport = page.getViewport({ scale: scale });

                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d");
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport,
                };

                page.render(renderContext).promise.then(function () {
                    const img = document.createElement("img");
                    img.src = canvas.toDataURL("image/png");
                    img.style.margin = "10px";
                    output.appendChild(img);
                });
            });
        }
    });
}

// -----------------------------------------------------------------------

let imageInput = document.getElementById("image-input");
let imageLabel = document.getElementById("image-input-label");

const maxFileSize = 10 * 1024 * 1024;

imageInput.addEventListener("change", (event) => {
    const file = event.target.files[0];

    if (file && file.type.startsWith("image/")) {
        if (file.size > maxFileSize) {
             Swal.fire({
                 position: "center",
                 icon: "error",
                 title: "ขนาดไฟล์ต้องไม่เกิน 10 MB",
                 showConfirmButton: false,
                 timer: 5000,
             });
            return;
        }

        const imageUrl = URL.createObjectURL(file);
        imageLabel.style.backgroundImage = `url(${imageUrl})`;
        imageLabel.style.backgroundSize = "contain";
    }
});

// -----------------------------------------------------------------------

let fileUpload = document.querySelector("#content-upload");

fileUpload.addEventListener("change", (event) => {
    let file = event.target.files[0];

    if (file.type === "application/pdf") {
        const fileReader = new FileReader();

        fileReader.onload = function () {
            const typedArray = new Uint8Array(this.result);

            pdfjsLib.getDocument(typedArray).promise.then(function (pdf) {
                const output = document.getElementById("output");
                output.innerHTML = "";

                for (
                    let pageNumber = 1;
                    pageNumber <= pdf.numPages;
                    pageNumber++
                ) {
                    pdf.getPage(pageNumber).then(function (page) {
                        const scale = 0.8;
                        const viewport = page.getViewport({ scale: scale });

                        const canvas = document.createElement("canvas");
                        const context = canvas.getContext("2d");
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport,
                        };
                        page.render(renderContext).promise.then(function () {
                            const img = document.createElement("img");
                            img.src = canvas.toDataURL("image/png");
                            img.style.margin = "10px";
                            output.appendChild(img);
                        });
                    });
                }
            });
        };

        fileReader.readAsArrayBuffer(file);
    } else {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "กรุณาอัปโหลดไฟล์เนื้อหา",
            showConfirmButton: false,
            timer: 5000,
        });
    }
});



// -----------------------------------------------------------------------

document.getElementById("form").addEventListener("submit", function (e) {
    e.preventDefault();

    Swal.fire({
        title: "กำลังอัปโหลดไฟล์...",
        text: "กำลังอัปเดตข้อมูล กรุณารอสักครู่",
        icon: "info",
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        },
    });
    this.submit();
});
