const userMenu = document.getElementById('user-menu');
const userOptions = document.querySelector('.user-options');
const profileInfo = document.getElementById('profile-info');
const editUserInfo = document.querySelector('.edit-user-info');
const editPassword = document.querySelector('.edit-password');
const editInfoButton = document.getElementById('edit-info');
const changePasswordButton = document.getElementById('change-password-btn');
const linkEditPassword = document.getElementById('link-change-password');

profileInfo.style.display = 'block';
userMenu.addEventListener('change', function() {
    document.querySelectorAll('.content-section').forEach(section => section.style.display = 'none');
    document.getElementById(this.value).style.display = 'block';
    editUserInfo.style.display = 'none';
});

editInfoButton.addEventListener('click', () => {
    profileInfo.style.display = 'none';
    editUserInfo.style.display = 'block';
});

document.getElementById('link-change-password').addEventListener('click', function(event) {
    event.preventDefault();
});
