const inputPassword = document.querySelector('#inputPassword');
const inputConfirmPassword = document.querySelector('#inputConfirmPassword');
const passwordVisibility = document.querySelector('.password_visibility');
const confirmPasswordVisibility = document.querySelector('.confirm-password_visibility');

const changeVisibilityPassword = (input, btn) => {
    const hiddenPassIcon = btn.querySelector('.pass-icon[data-visible="hidden"]');
    const visiblePassIcon = btn.querySelector('.pass-icon[data-visible="visible"]');
    const status = input.getAttribute('type') === 'password' ? 'hidden' : 'visible';
    if(status === 'hidden'){
        visiblePassIcon.classList.remove('d-none');
        hiddenPassIcon.classList.add('d-none');
        input.setAttribute('type' , 'text');
        console.log(status);
    }else if(status === 'visible'){
        visiblePassIcon.classList.add('d-none');
        hiddenPassIcon.classList.remove('d-none');
        input.setAttribute('type', 'password');
        console.log(status)
    }
}


passwordVisibility.addEventListener('click', () => {
    changeVisibilityPassword(inputPassword, passwordVisibility);
});
confirmPasswordVisibility.addEventListener('click', () => {
    changeVisibilityPassword(inputConfirmPassword, confirmPasswordVisibility);
});