const userMenu = document.getElementById('user-menu');
const userOptions = document.querySelector('.user-options');
const profileInfo = document.getElementById('profile-info');
const editUserInfo = document.querySelector('.edit-user-info');
const editPassword = document.querySelector('.edit-password');

const editInfoButton = document.getElementById('edit-info');
const changePasswordButton = document.getElementById('change-password');
const linkEditPassword = document.getElementById('link-edit-password');

function display(hideElement, showElement) {
    hideElement.style.display = 'none';
    showElement.style.display = 'block';
}

profileInfo.style.display = 'block';
userMenu.addEventListener('mouseover', () => userMenu.style.cursor = 'pointer');

userMenu.addEventListener('change', function() {
    document.querySelectorAll('.content-section').forEach(section => section.style.display = 'none');
    document.getElementById(this.value).style.display = 'block';
    editUserInfo.style.display = 'none';
});

editInfoButton.addEventListener('click', () => {
    display(profileInfo, editUserInfo);
});

// changePasswordButton.addEventListener('click', () => {
//     display(userOptions, editPassword);
//     profileInfo.style.display = 'none';
// });


// linkEditPassword.addEventListener('click', () => {
//     display(userOptions, editPassword);
//     profileInfo.style.display = 'none';
//     editUserInfo.style.display = 'none';
// });




