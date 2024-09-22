// const userMenu = document.getElementById('user-menu');
// const userOptions = document.querySelector('.user-options');
// const profileInfo = document.getElementById('profile-info');
// const editUserInfo = document.querySelector('.edit-user-info');
// const editPassword = document.querySelector('.edit-password');
// const editInfoButton = document.getElementById('edit-info');
// const changePasswordButton = document.getElementById('change-password-btn');
// const linkEditPassword = document.getElementById('link-change-password');

// profileInfo.style.display = 'block';
// userMenu.addEventListener('change', function() {
//     document.querySelectorAll('.content-section').forEach(section => section.style.display = 'none');
//     document.getElementById(this.value).style.display = 'block';
//     editUserInfo.style.display = 'none';
// });

// editInfoButton.addEventListener('click', () => {
//     profileInfo.style.display = 'none';
//     editUserInfo.style.display = 'block';
// });

// document.getElementById('link-change-password').addEventListener('click', function(event) {
//     event.preventDefault();
// });

function handleMenuChange() {
    const selectedOption = document.getElementById('user-menu').value;
    if (selectedOption) {
        window.location.href = selectedOption;
    }
}

// password
function validatePasswordLength() {
    const password = document.getElementById("n-password").value
    const passwordP = document.getElementById("password-w")
    if(password == ""){
        passwordP.textContent = ""
    }else if(password.length < 8){
        passwordP.classList.add("text-secondary")
        passwordP.classList.remove("text-success")
        passwordP.textContent = "รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร"
    }else{
        passwordP.classList.remove("text-secondary")
        passwordP.classList.add("text-success")
        passwordP.textContent = "รหัสผ่านถูกต้อง"
    }
}
document.getElementById("n-password").addEventListener("input", validatePasswordLength);
document.getElementById("c-password").addEventListener("input", () => {
    const password = document.getElementById("n-password").value
    const confirmPassword = document.getElementById("c-password").value;
    const confirmPasswordP = document.getElementById("confirm-w")
    if(confirmPassword == ""){
        confirmPasswordP.textContent = ""
    }else if(confirmPassword !== password){
        confirmPasswordP.classList.add("text-secondary")
        confirmPasswordP.classList.remove("text-success")
        confirmPasswordP.textContent = "รหัสผ่านไม่ตรงกัน"
    }else{
        confirmPasswordP.classList.remove("text-secondary")
        confirmPasswordP.classList.add("text-success")
        confirmPasswordP.textContent = "รหัสผ่านตรงกัน"
    }
});
