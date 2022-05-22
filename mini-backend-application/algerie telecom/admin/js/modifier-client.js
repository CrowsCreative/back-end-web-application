const inputPassword = document.querySelector('#inputPassword');
const inputConfirmPassword = document.querySelector('#inputConfirmPassword');
const passwordVisibility = document.querySelector('.password_visibility');
const confirmPasswordVisibility = document.querySelector('.confirm-password_visibility');
const form = document.querySelector('form');

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

form.addEventListener('submit', e => {
    // e.preventDefault();
    
    if(e.target.password.value === e.target.confirmPassword.value){
        /* send the informations */
    }

    // e.target.nome.value
    // e.target.prenom.value
    // e.target.username.value
    // e.target.naissance.value     /* we will use =>  const naissance = new Date(e.target.naissance.value); naissance.getTime();*/
    // e.target.address.value
    // e.target.carte_national.value
    // e.target.email.value
    // e.target.phone.value
    // e.target.password.value
    // e.target.confirmPassword.value
    // e.target.capaciteFinanciere.value
    // e.target.typeTravaille.value
    // e.target.idBank.value
    // e.target.permission.value
    // e.target.created_at.value  /* we will use =>  const created_at = new Date(e.target.created_at.value);   created_at.getTime();*/

});

