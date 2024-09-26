// password
function validatePasswordLength() {
    const newPassword = document.getElementById("n-password").value
    const passwordP = document.getElementById("password-w")
    if(newPassword == ""){
        passwordP.textContent = ""
    }else if(newPassword.length < 8){
        passwordP.classList.add("text-secondary")
        passwordP.classList.remove("text-success")
        passwordP.textContent = "รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร"
    }else{
        passwordP.classList.remove("text-secondary")
        passwordP.classList.add("text-success")
        passwordP.textContent = "รหัสผ่านถูกต้อง"
    }
}
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("n-password").addEventListener("input", validatePasswordLength);
    document.getElementById("c-password").addEventListener("input", () => {
        const newPassword = document.getElementById("n-password").value;
        const confirmPassword = document.getElementById("c-password").value;
        const confirmPasswordP = document.getElementById("confirm-w");

        if (confirmPassword == "") {
            confirmPasswordP.textContent = "";
        } else if (confirmPassword !== newPassword) {
            confirmPasswordP.classList.add("text-secondary");
            confirmPasswordP.classList.remove("text-success");
            confirmPasswordP.textContent = "รหัสผ่านไม่ตรงกัน";
        } else {
            confirmPasswordP.classList.remove("text-secondary");
            confirmPasswordP.classList.add("text-success");
            confirmPasswordP.textContent = "รหัสผ่านตรงกัน";
        }
    });
});

document.getElementById('camera-icon').addEventListener('click', function() {
    document.getElementById('inputImageID').click();

    document.getElementById("inputImageID").addEventListener("change",(event)=>{
        const file = event.target.files[0];
        const maxFileSize = 10 * 1024 * 1024;

        if(file){
            const imageUrl = URL.createObjectURL(file)
            document.getElementById("profile-image").src = imageUrl
        }
    })
});


