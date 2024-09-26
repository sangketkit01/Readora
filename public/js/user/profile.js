document.getElementById('camera-icon').addEventListener('click', function() {
    document.getElementById('inputImage').click();
});

// password
function validatePasswordLength() {
    const newPassword = document.getElementById("new_password").value
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
    document.getElementById("new_password").addEventListener("input", validatePasswordLength);
    document.getElementById("comfirm_password").addEventListener("input", () => {
        let newPassword = document.getElementById("new_password").value;
        let confirmPassword = document.getElementById("comfirm_password").value;
        let confirmPasswordP = document.getElementById("confirm-w");

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

