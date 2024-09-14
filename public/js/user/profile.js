const userMenu = document.getElementById('user-menu');
const userOptions = document.querySelector('.user-options');
const profileInfo = document.getElementById('profile-info');
const editUserInfo = document.querySelector('.edit-user-info');
const editPassword = document.querySelector('.edit-password');
const editInfoButton = document.getElementById('edit-info');
const changePasswordButton = document.getElementById('change-password-btn');
const linkEditPassword = document.getElementById('link-change-password');

profileInfo.style.display = 'block';

userMenu.addEventListener('mouseover', () => userMenu.style.cursor = 'pointer');

userMenu.addEventListener('change', function() {
    document.querySelectorAll('.content-section').forEach(section => section.style.display = 'none');
    document.getElementById(this.value).style.display = 'block';
    editUserInfo.style.display = 'none';
});

editInfoButton.addEventListener('click', () => {
    profileInfo.style.display = 'none';
    editUserInfo.style.display = 'block';
});

//popup
document.addEventListener('DOMContentLoaded', function () {
    const popup = document.querySelector('.popup');
    const popup2 = document.querySelector('.popup2');

    const blurLayer = document.createElement('div');
    blurLayer.classList.add('blur-layer');
    document.body.appendChild(blurLayer);
    const overlay = document.createElement('div');
    overlay.classList.add('overlay');
    document.body.appendChild(overlay);

    document.querySelector('.popup .close-btn').addEventListener('click', function() {
        popup.classList.remove('active');
        blurLayer.style.display = 'none';
        overlay.style.display = 'none';
    });
    document.querySelectorAll('#link-change-password, #change-password-btn').forEach(element => {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            popup.classList.add('active');
            blurLayer.style.display = 'block';
            overlay.style.display = 'block';
        });
    });

    document.querySelector('.popup2 .close-btn').addEventListener('click', function() {
        popup2.classList.remove('active');
        blurLayer.style.display = 'none';
        overlay.style.display = 'none';
    });
    document.querySelector('#add-password-btn').addEventListener('click', function(event) {
            event.preventDefault();
            popup2.classList.add('active');
            blurLayer.style.display = 'block';
            overlay.style.display = 'block';
    });
    
});

// add password
// document.getElementById('add-password-form').addEventListener('submit', function(event) {
//     let newPassword = document.getElementById('new_password').value;
//     let confirmPassword = document.getElementById('confirm_password').value;
//     let errorElement = document.getElementById('password-error');

//     if (errorElement) {
//         errorElement.remove();
//     }
//     if (newPassword !== confirmPassword) {
//         event.preventDefault(); 
//         showError('รหัสผ่านไม่ตรงกัน');
//     } else if (newPassword.length < 8) {
//         event.preventDefault();
//         showError('รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร');
//     }
// });

// function showError(message) {
//     let errorElement = document.createElement('div');
//     errorElement.id = 'password-error';
//     errorElement.style.color = 'red';
//     errorElement.textContent = message;
//     document.querySelector('.form-element').appendChild(errorElement);
// }




